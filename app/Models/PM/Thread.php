<?php
namespace CMV\Models\PM;

use CMV\Jobs\PM\SendMessageNotifications;
use CMV\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Thread extends Model {

    use SoftDeletes, DispatchesJobs;

    const REF_PROJECT = 'project';
    const REF_TODO = 'todo';

    protected $columns = [
        'id',
        'reference_id',
        'reference_type', //concierge_site || project,
        'message_count',
        'last_message_preview',
        'last_message_id',
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reference()
    {
        $ref = implode('', array_map(function($part) {
            return ucfirst($part);
        }, explode('_', $this->reference_type)));

        return $this->belongsTo('CMV\Models\PM\\'.$ref, 'reference_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('CMV\Models\PM\Message');
    }

    /**
     * @param User $user
     * @param $content
     * @return Message
     */
    public function addMessage(User $user, $content)
    {
        $message = new Message();
        $message->user()->associate($user);

        $message->content = $this->replaceLinksWithAnchors($content);
        $message->save();

        $this->messages()->save($message);

        $this->touch();
        $this->last_message_id = $message->id;
        $this->last_message_preview = substr($content, 0, 100);
        $this->message_count = $this->messages()->count();
        $this->save();

        $this->dispatch(new SendMessageNotifications($message));

        return $message;
    }

    /**
     * Replaces text links with anchors. Using iterator b/c the links could be already wrapped in the <a> tag.
     * @param $content
     * @return mixed
     */
    private function replaceLinksWithAnchors($content)
    {
        $dom = new \DOMDocument;
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $nodes = new \RecursiveIteratorIterator(
            new \RecursiveDOMIterator($dom),
            \RecursiveIteratorIterator::SELF_FIRST);

        foreach($nodes as $node) {
            if($node->nodeType === XML_TEXT_NODE) {
                if ($node->parentNode && $node->parentNode->nodeName != 'a') {
                    $pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                    $replacement = '<a href="$0" target="_blank">$0</a>';
                    $node->nodeValue = preg_replace($pattern, $replacement, $node->nodeValue);
                }
            }
        }

        return str_replace(['&lt;', '&gt;'], ['<', '>'], $dom->saveHTML());
    }
}
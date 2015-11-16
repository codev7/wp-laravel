<?php
namespace CMV\Models\PM;

use CMV\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model {

    use SoftDeletes;

    const REF_PROJECT = 'project';
    const REF_CONCIERGE = 'concierge_site';
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
        $message->content = $content;
        $message->save();

        $this->messages()->save($message);

        $this->touch();
        $this->last_message_id = $message->id;
        $this->last_message_preview = substr($content, 0, 100);
        $this->message_count = $this->messages()->count();
        $this->save();

        return $message;
    }
}
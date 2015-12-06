<?php

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Each project in the system can have many project briefs.
 * Project briefs each need to get approved by the client.
 * We will potentially store revisions of these.
 */
class ProjectBrief extends Model
{
    use SoftDeletes;

    const TYPE_FRONTEND = 'frontend';
    const TYPE_WP = 'wordpress';
    const TYPE_OTHER = 'other';

    /**
     * @var array
     */
    protected $relatedBriefs = [];

    protected $columns = [
        'id',
        'text', //will most likely be some sort of json until I figure out actual data structure for the ProjectBriefs
        'project_id',
        'created_by_id',
        'approved_by_customer_id',
        'approved_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'text' => 'array',
    ];


    /**
     * @return mixed
     */
    public function files()
    {
        return $this->hasMany('CMV\Models\PM\File', 'reference_id')
            ->where('reference_type', File::REF_BRIEF);
    }


    public function project()
    {
        return $this->belongsTo('CMV\Models\PM\Project');
    }

    public function createdByUser()
    {
        return $this->belongsTo('CMV\User', 'created_by_id');
    }

    public function approvedByUser()
    {
        return $this->belongsTo('CMV\User', 'approved_by_customer_id');
    }

    /**
     * the following methods are helpers for the brief view page
     */


    public function getTypeDescription()
    {
        switch ($this->text['brief_type']) {
            case self::TYPE_FRONTEND:
                return 'A front end brief covers all details about the HTML/CSS/JavaScript of this project.';
                break;
            case self::TYPE_WP:
                return 'A WordPress brief covers all details about the WordPress implementation of this project.';
                break;
            case self::TYPE_OTHER:
            default:
                return 'Brief covers all details about the implementation of this project.';
                break;
        }
    }

    public function getFinishedAtString()
    {
        return $this->finished_at ?
            $this->finished_at->format('F d, Y') :
            'Not finished yet';
    }

    public function briefBoxes()
    {
        if (isset($this->text['brief_boxes'])) return $this->text['brief_boxes'];

        $boxes = [
            'views' => [
                'title' => '%d View',
                'description' => '# of Page Templates',
                'tooltip' => 'These are the unique pages that we will turn into a pixel perfect front end.'
            ],
            'modals' => [
                'title' => '%d Modal',
                'description' => '# of Modal Views',
                'tooltip' => 'These are the modal windows that we will be included in the front end.'
            ],
            'layout_type' => [
                'title' => '%s',
                'description' => "Layout Type",
                'tooltip' => 'This is the layout type we will use. A responsive layout will be fully responsive to the width of the browser / device. <br /><br />Other Options:</strong><br />Fixed / Mobile-only / Fluid'
            ],
            'templates' => [
                'title' => '%d Template',
                'description' => '# of Custom<br/> Page Templates',
                'tooltip' => 'These are page templates that will be re-usable in the WordPress CMS.'
            ],
            'post_types' => [
                'title' => '%d Post Type',
                'description' => '# of Custom<br/> Post Types',
                'tooltip' => 'These are the custom post types that will be coded in the theme.'
            ],
            'endpoints' => [
                'title' => '%d Endpoint',
                'description' => '# of Forms<br/> Endpoints',
                'tooltip' => 'These are the number of forms or functionality endpoints that will be coded into the theme.'
            ]
        ];

        foreach ($boxes as $key => $info) {
            if (isset($this->text[$key])) {
                $value = $this->text[$key];
                if (is_array($value)) {
                    $count = count($value);
                    $boxes[$key]['title'] = sprintf($info['title'], $count);
                    if ($count > 1) $boxes[$key]['title'] .= 's';
                } else {
                    $boxes[$key]['title'] = sprintf($info['title'], ucfirst($value));
                }
            } else {
                unset($boxes[$key]);
            }
        }

        return $boxes;
    }

    public function relatedBriefs()
    {
        if (!$this->text['related_to_brief']) return [];

        if (!$this->relatedBriefs) {
            foreach ($this->text['related_to_brief'] as $relatedId) {
                $related = ProjectBrief::find($relatedId);
                if ($related) $this->relatedBriefs[] = $related;
            }
        }

        return $this->relatedBriefs;
    }

    public function getValue($path)
    {
        $keys = explode('.', $path);
        $res = $this->text;

        foreach (array_reverse($keys) as $key) {
            if (isset($res[$key])) $res = $res[$key];
            else return null;
        }

        return $res;
    }

    /**
     * @param array $checklist
     * @return array
     */
    public function normalizeChecklist(array $checklist)
    {
        $res = [];

        foreach ($checklist as $checkItem) {
            if (!isset($res[$checkItem['category']])) {
                $res[$checkItem['category']] = [];
            }

            if ($checkItem['screenshots']) {
                $checkItem['screenshots'] = $this->expandScreenshots($checkItem['screenshots']);
            }

            $res[$checkItem['category']][] = $checkItem;
        }

        // if there's only one category - return without categories
        if (count($res) == 1) return array_values(array_shift($res));

        return $res;
    }

    /**
     * @param array $screenshots
     * @return array
     */
    public function expandScreenshots(array $screenshots)
    {
        $res = [];
        foreach ($screenshots as $fileId) {
            $res[] = File::find($fileId)->toArray();
        }

        return $res;
    }

}

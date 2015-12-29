<?php
namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    const REF_PROJECT = 'project';
    const REF_BRIEF = 'project_brief';
    const REF_TODO = 'todo';
    //..

    protected $columns = [
        'id',
        'reference_type',
        'reference_id',
        'path',
        'name',
        'mime',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('CMV\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|null
     */
    public function reference()
    {
        switch ($this->reference_type) {
            case static::REF_PROJECT:
                return $this->belongsTo('CMV\Models\PM\Project', 'reference_id');
            case static::REF_TODO:
                return $this->belongsTo('CMV\Models\PM\ToDo', 'reference_id');
            case static::REF_BRIEF:
                return $this->belongsTo('CMV\Models\PM\ProjectBrief', 'reference_id');
            default:
                return null;
        }
    }

}
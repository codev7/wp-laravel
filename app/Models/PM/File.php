<?php
namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    const REF_PROJECT = 'project';
    const REF_CONCIERGE = 'concierge_site';
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
            case static::REF_CONCIERGE:
                return $this->belongsTo('CMV\Models\PM\ConciergeSite', 'reference_id');
            default:
                return null;
        }
    }

}
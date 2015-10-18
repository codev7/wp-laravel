<?php

namespace CMV;

use Laravel\Spark\Teams\Team as SparkTeam;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends SparkTeam
{
    use SoftDeletes;

    protected $columns = [
        'id',
        'owner_id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function projects()
    {
        return $this->hasMany('CMV\Models\PM\Project');
    }
    
    
    public function invoice()
    {
        return $this->hasManyThrough('CMV\Models\PM\Invoice','CMV\Models\PM\Project');
    }

    public function conciergeSites()
    {
        return $this->hasMany('CMV\Models\PM\ConciergeSite');
    }

    public function scopeRandom($query)
    {
        return $query->orderBy(\DB::raw('RAND()'));
    }

}

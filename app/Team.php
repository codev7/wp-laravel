<?php

namespace CMV;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Spark\Teams\Team as SparkTeam;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends SparkTeam
{
    use SoftDeletes;

    protected $columns = [
        'id',
        'owner_id',
        'name',
        'nda_agreed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function projects()
    {
        return $this->hasMany('CMV\Models\PM\Project', 'team_id', 'id');
    }
    
    public function owner()
    {
        return $this->belongsTo('CMV\User', 'owner_id');
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

    /**
     * Sets nda_agreed_at to current time if it's null
     */
    public function agreeToNDA()
    {
        $this->nda_agreed_at = \Carbon\Carbon::now();
        $this->save();
    }

    /**
     * @return BelongsToMany;
     */
    public function users()
    {
        return $this->belongsToMany('CMV\User', 'user_teams')
            ->withPivot('team_id', 'user_id', 'role');
    }

}

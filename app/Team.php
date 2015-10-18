<?php

namespace CMV;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

use Laravel\Spark\Teams\Team as SparkTeam;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends SparkTeam implements BillableContract
{
    use Billable, SoftDeletes;

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

    public function invoices()
    {
        return $this->hasManyThrough('CMV\Models\PM\Invoice','CMV\Models\PM\Project');
    }

    public function conciergeSites()
    {
        return $this->hasMany('CMV\Models\PM\ConciergeSite');
    }
}

<?php

namespace CMV\Models\Prospector;

use Illuminate\Database\Eloquent\Model;

/**
* The Contact object belongs to a company.
* This is where we store individual contact information for
* a potential prospect at a company.
*/
class Contact extends Model
{   
    protected $columns = [
        'id',
        'email',
        'first_name',
        'last_name',
        'company_id',
        'pipeline_deals_id',
        'created_at',
        'updated_at'
    ];

    protected $fillable = ['email'];    

    public function company()
    {

        return $this->belongsTo('CMV\Models\Prospector\Company');

    }

    public function activities()
    {

        return $this->hasMany('CMV\Models\Prospector\Activity');

    }

    public function getTimeOfLastActivity()
    {   
        if($this->activities->count() == 0) return '<em class="text-muted">never contacted</em>';

        return $this->activities->sortByDesc('created_at')->first()->created_at->diffForHumans();
    }

    public function meta()
    {

        return $this->hasMany('CMV\Models\Prospector\ContactMeta');

    }

    public function scopeRandom($query)
    {
        return $query->orderBy(\DB::raw('RAND()'));
    }
}

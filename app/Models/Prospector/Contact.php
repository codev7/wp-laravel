<?php

namespace CMV\Models\Prospector;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['email'];

    public function company()
    {

        return $this->belongsTo('Company');

    }

    public function activities()
    {

        return $this->hasMany('Activity');

    }

    public function getTimeOfLastActivity()
    {   
        if($this->activities->count() == 0) return '<em class="text-muted">never contacted</em>';

        return $this->activities->sortByDesc('created_at')->first()->created_at->diffForHumans();
    }

    public function meta()
    {

        return $this->hasMany('ContactMeta');

    }
}

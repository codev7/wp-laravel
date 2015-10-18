<?php

namespace CMV\Models\Prospector;

use Illuminate\Database\Eloquent\Model;

class CompanyMeta extends Model
{
    protected $fillable = ['key','value'];

    public function company()
    {

        return $this->belongsTo('Company');

    }
}

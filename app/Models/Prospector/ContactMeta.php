<?php

namespace CMV\Models\Prospector;

use Illuminate\Database\Eloquent\Model;

class ContactMeta extends Model
{
    protected $fillable = ['key','value'];

    public function contact()
    {

        return $this->belongsTo('Contact');

    }
}

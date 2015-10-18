<?php

namespace CMV\Models\Prospector;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['content'];

    public function company()
    {

        return $this->belongsTo('Company');

    }


    public function contact()
    {

        return $this->belongsTo('Contact');

    }


    public function salesRep()
    {

        return $this->belongsTo('CMV\User','sales_rep_id');

    }
}

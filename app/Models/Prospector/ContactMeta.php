<?php

namespace CMV\Models\Prospector;

use Illuminate\Database\Eloquent\Model;

/**
* Table to store contact meta data.  Maybe could just
* use mongodb for this data?
*/
class ContactMeta extends Model
{   
    protected $columns = [
        'id',
        'key',
        'value',
        'contact_id',
        'created_at',
        'updated_at'
    ];

    protected $fillable = ['key','value'];

    public function contact()
    {

        return $this->belongsTo('CMV\Models\Prospector\Contact');

    }
}

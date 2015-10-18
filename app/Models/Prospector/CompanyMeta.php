<?php

namespace CMV\Models\Prospector;

use Illuminate\Database\Eloquent\Model;

/**
* Table to store company meta data.  Maybe could just
* use mongodb for this data?
*/
class CompanyMeta extends Model
{   
     protected $columns = [
        'id',
        'key',
        'value',
        'company_id',
        'created_at',
        'updated_at'
    ];

    protected $fillable = ['key','value'];

    public function company()
    {

        return $this->belongsTo('CMV\Models\Prospector\Company');

    }
}

<?php 

namespace CMV;

use Illuminate\Database\Eloquent\Model;

class Awwward extends Model {

    protected $fillable = ['username'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('CMV\Awwwcategory', 'awwward_category', 'awwward_id', 'awwwcategory_id');
    }

}

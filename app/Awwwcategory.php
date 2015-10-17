<?php 

namespace CMV;

use Illuminate\Database\Eloquent\Model;

class Awwwcategory extends Model {

    public $timestamps = false;

    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function awwwards()
    {
        return $this->belongsToMany('CMV\Awwwcategory', 'awwward_category', 'awwwcategory_id', 'awwward_id');
    }

}

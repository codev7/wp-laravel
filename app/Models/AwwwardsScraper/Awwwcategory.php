<?php 

namespace CMV\Models\AwwwardsScraper;

use Illuminate\Database\Eloquent\Model;

class Awwwcategory extends Model {

    public $timestamps = false;

    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function awwwards()
    {
        return $this->belongsToMany('Awwwcategory', 'awwward_category', 'awwwcategory_id', 'awwward_id');
    }

}

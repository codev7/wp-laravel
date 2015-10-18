<?php 

namespace CMV\Models\AwwwardsScraper;

use Illuminate\Database\Eloquent\Model;

class Awwward extends Model {

    protected $fillable = ['username'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('Awwwcategory', 'awwward_category', 'awwward_id', 'awwwcategory_id');
    }

}

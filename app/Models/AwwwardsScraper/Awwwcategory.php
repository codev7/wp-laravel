<?php 

namespace CMV\Models\AwwwardsScraper;

use Illuminate\Database\Eloquent\Model;

/**
 * The model is used to hold data that we scrape
 * from the http://www.awwwards.com website.
 */
class AwwwCategory extends Model {

    protected $table = 'awwwcategories';

    protected $columns = [
        'id',
        'name' //name of the category
    ];
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

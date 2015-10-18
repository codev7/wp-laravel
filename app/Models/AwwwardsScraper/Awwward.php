<?php 

namespace CMV\Models\AwwwardsScraper;

use Illuminate\Database\Eloquent\Model;

/**
 * The model is used to hold data that we scrape
 * from the http://www.awwwards.com website.
 */
class Awwward extends Model {

    protected $columns = [
        'id',
        'username',
        'name',
        'site_url',
        'twitter',
        'gplus',
        'facebook',
        'linkedin',
        'skype',
        'country',
        'city',
        'karma',
        'created_at',
        'updated_at',

    ];

    protected $fillable = ['username'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('Awwwcategory', 'awwward_category', 'awwward_id', 'awwwcategory_id');
    }

}

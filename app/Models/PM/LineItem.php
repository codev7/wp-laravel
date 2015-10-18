<?php 

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;

/**
* This model holds the data that relates to each line item
* on the invoices in the system.
* We try to categorize invoices by the categories you see below.
*/
class LineItem extends Model {

	protected $columns = [
        'id',
        'invoice_id',
        'name',
        'description',
        'price',
        'category', //front_end|back_end|wordpress|javascript|design
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'description',
        'unit_price',
        'category'
    ]; 

    public static $categories = [
        'front_end',
        'back_end',
        'wordpress',
        'javascript',
        'design'
    ];


    public function invoice()
    {
        return $this->belongsTo('CMV\Models\PM\Invoice');
    }

}

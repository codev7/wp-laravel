<?php 

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;

class LineItem extends Model {

	protected $columns = [
        'id',
        'invoice_id',
        'name',
        'description',
        'price',
        'category',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'description',
        'unit_price',
        'category'
    ]; 


    public function invoice()
    {
        return $this->belongsTo('Invoice');
    }

}

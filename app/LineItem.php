<?php 

namespace CMV;

use Illuminate\Database\Eloquent\Model;

class LineItem extends Model {

	protected $columns = [
        'id',
        'name',
        'description',
        'unit_price',
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

}

<?php 

namespace CMV;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

    use SoftDeletes;
    
    protected $columns = [
        'id',
        'line_items',
        'invoice_total',
        'discount',
        'status',
        'date_paid',
        'project_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'line_items' => 'array',
    ];

    protected $fillable = [];

    protected $guarded = ['*'];
    
    protected $dates = [
        'date_paid',
        'created_at',
        'updated_at',
        'deleted_at'
    ];



    public function project()
    {

        return $this->belongsTo( 'CMV\Project' );

    }

}

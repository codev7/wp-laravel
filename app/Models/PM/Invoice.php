<?php 

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

    use SoftDeletes;
    
    protected $columns = [
        'id',
        'discount',
        'status',
        'date_paid',
        'reference_id',
        'reference_type', //concierge_site || project
        'customer_id',
        'stripe_invoice_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [];

    protected $guarded = ['*'];
    
    protected $dates = [
        'date_paid',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function lineItems()
    {
        return $this->hasMany('LineItem');
    }

    public function customer()
    {
        return $this->belongsTo('CMV\User','customer_id');
    }

    public function project()
    {

        return $this->belongsTo( 'Project', 'reference_id');

    }


    public function conciergeSite()
    {
        return $this->belongsTo( 'ConciergeSite', 'reference_id');
    }

}

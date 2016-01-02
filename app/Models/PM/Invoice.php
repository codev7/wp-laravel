<?php 

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
* The model holds invoices that are in the system.
* An invoice can be associated with a Project object,
* In most cases, an invoice will have a stripe_invoice_id.
*/
class Invoice extends Model {

    use SoftDeletes;
    
    protected $columns = [
        'id',
        'discount',
        'status',
        'date_paid',
        'project_id',
        'stripe_invoice_id',
        'stripe_upfront_invoice_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'project_id',
        'customer_id',
        'brief_id',
        'date',
        'brief.brief_type',
        'discount_percent',
        'line_items',
        'speeds',
        'upfront_percent',
        'users_to_notify'
    ];

    protected $guarded = ['*'];
    
    protected $dates = [
        'date',
        'date_paid',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'speeds' => 'array',
        'users_to_notify' => 'array',
        'line_items' => 'array'
    ];

    public static $statuses = ['draft','sent','unpaid', 'deposit_paid', 'paid'];

    protected $appends = ['depositAmount', 'finalAmount', 'grandTotal', 'discountAmount', 'speedAmount', 'subTotal'];

    public static function boot()
    {
        parent::boot();

        static::creating(function($invoice) {
            $invoice->created_by = \Auth::user()->id;
            $invoice->status = 'draft';
            $invoice->amount = $invoice->grandTotal();
        });

        static::saving(function ($invoice) {
            if ($invoice->brief_id == '') $invoice->brief_id = null;
            $invoice->amount = $invoice->grandTotal();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('CMV\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo( 'CMV\Models\PM\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brief()
    {
        return $this->belongsTo('CMV\Models\PM\ProjectBrief');
    }

    public function getSpeedsAttribute($value)
    {
        $now = \Carbon\Carbon::now();

        // title, timeframes, enabled, delivery_date, multiplier
        return ! $value ? [
            ['title' => 'Standard Turnaround', 'timeframes' => '5-10 business days', 'enabled' => true, 'delivery_date' => $now->addDays(10)->format('m-d-Y'), 'multiplier' => 100],
            ['title' => 'Rush Turnaround', 'timeframes' => '3-5 business days', 'enabled' => true, 'delivery_date' => $now->addDays(5)->format('m-d-Y'), 'multiplier' => 120],
            ['title' => 'Urgent Turnaround', 'timeframes' => '1-3 business days', 'enabled' => true, 'delivery_date' => $now->addDays(3)->format('m-d-Y'), 'multiplier' => 150],
        ] : (is_array($value) ? $value : json_decode($value, true));

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany('\CMV\Models\PM\InvoicePayment');
    }

    /**
     * @return bool
     */
    public function isDeletable()
    {
        return array_search($this->status, ['draft', 'sent']) !== false;
    }

    /**
     * @return bool
     */
    public function isDepositPayed()
    {
        $payments = $this->payments;
        foreach ($payments as $p) {
            if ($p->code == 'deposit' && $p->stripe_transaction_id)
                return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isFinalPayed()
    {
        $payments = $this->payments;
        foreach ($payments as $p) {
            if ($p->code == 'final' && $p->stripe_transaction_id)
                return true;
        }
        return false;
    }

    public function subTotal()
    {
        $res = 0;
        foreach ($this->line_items as $item) {
            $res += ($item['price'] * $item['quantity']);
        }
        return $res;
    }

    public function speedAmount()
    {
        $speed = $this->speeds[$this->speed ?: 0];

        return ceil($this->subtotal() * (($speed['multiplier'] - 100) / 100));
    }

    public function discountAmount()
    {
        $subTotal = $this->subTotal();
        $speed = $this->speeds[$this->speed ?: 0];

        return ceil($subTotal * ($speed['multiplier']/100) * ($this->discount_percent/100));
    }

    public function grandTotal()
    {
        $subTotal = $this->subTotal();
        $speed = $this->speeds[$this->speed ?: 0];

        return ceil($subTotal * ($speed['multiplier']/100) * ((100-$this->discount_percent)/100) );
    }

    /**
     *
     */
    public function depositAmount()
    {
        return ceil($this->grandTotal() * ($this->upfront_percent / 100));
    }

    /**
     *
     */
    public function finalAmount()
    {
        return ceil($this->grandTotal() - $this->depositAmount());
    }

    public function getSpeedAmountAttribute() {return $this->speedAmount();}
    public function getDiscountAmountAttribute() {return $this->discountAmount();}
    public function getDepositAmountAttribute() {return $this->depositAmount();}
    public function getFinalAmountAttribute() {return $this->finalAmount();}
    public function getGrandTotalAttribute() {return $this->grandTotal();}
    public function getSubTotalAttribute() {return $this->subTotal();}
}

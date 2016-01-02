<?php

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model {

    use SoftDeletes;

    const TYPE_DEPOSIT = 'deposit';
    const TYPE_FINAL = 'final';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo('\CMV\Models\PM\Invoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payer()
    {
        return $this->belongsTo('\CMV\User', 'payer_id');
    }

}

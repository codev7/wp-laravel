<?php
namespace CMV\Services;

use CMV\Models\PM\Invoice;
use CMV\Models\PM\ProjectBrief;
use CMV\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Handles creating threads and messages
 * Class InvoicesService
 * @package CMV\Services
 */
class InvoicesService {

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Invoice
     */
    protected $invoice;

    /**
     * @param User $user
     * @param Invoice $invoice
     */
    public function __construct(User $user, Invoice $invoice)
    {
        $this->user = $user;
        $this->project = $invoice;
    }

    /**
     * @return HasMany
     */
    public function all()
    {
        $query = $this->project->briefs();

        if ($this->user->is_admin == false && $this->user->is_mastermind == false) {
            $query->whereNotNull('approved_by_admin_id');
        }

        return $query;
    }

    /**
     */
    public function sendToClient()
    {

    }

    /**
     */
    public function approve()
    {

    }

}
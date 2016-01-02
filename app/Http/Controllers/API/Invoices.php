<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Invoice;
use CMV\Models\PM\InvoicePayment;
use CMV\Models\PM\Project;
//use CMV\Models\PM\ProjectBrief;
//use CMV\Services\invoicesService;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Input, Auth, Validator;

/**
 * @Middleware("param-access")
 * @package CMV\Http\Controllers\API
 */
class invoices extends Controller {

    /**
     * @var invoicesService
     */
    protected $service;

    public function __construct()
    {
        $project = Project::find(\Request::route('projects'));
//        $this->service = new invoicesService(Auth::user(), $project);
    }

    /**
     * @Get("api/projects/{projects}/invoices")
     */
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);

        $invoices = isAdmin() ?
            $project->invoices() :
            $project->invoices()->where('status', '!=', 'draft');

        return $this->respondWithData($invoices->with('createdBy', 'brief')->get()->toArray());
    }

    /**
     * @Get("api/projects/{projects}/invoices/{invoices}")
     * @param $projectId
     * @param $invoiceId
     */
    public function show($projectId, $invoiceId)
    {
        $project = Project::findOrFail($projectId);
        $invoice = $project->invoices()->findOrFail($invoiceId);
        $invoice->load('project', 'createdBy', 'payments', 'payments.payer');

        return $this->respondWithData($invoice->toArray());
    }

    /**
     * @Post("api/projects/{projects}/invoices")
     */
    public function create(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        $data = $request->except('amount', 'amount_payed', 'date_paid', 'speed');

        $validator = Validator::make($data, [
            'brief_id' => 'exists:project_briefs,id',
            'date' => 'required|date',
            'discount_percent' => 'required|numeric|between:0,99',
            'line_items' => 'array',
            'speeds' => 'array',
            'upfront_percent' => 'required|numeric|between:0,99',
            'users_to_notify' => 'array'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $data['date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $data['date'])->format('Y-m-d');
        $data['project_id'] = $project->id;
        $invoice = Invoice::create($data);

        return $this->respondWithData($invoice->toArray());
    }

    /**
     * @Put("api/projects/{projects}/invoices/{invoices}")
     * @param Request $request
     * @param $projectId
     * @param $invoiceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $projectId, $invoiceId)
    {
        $project = Project::findOrFail($projectId);
        /** @var Invoice $invoice */
        $invoice = $project->invoices()->findOrFail($invoiceId);

        $data = $request->except('amount', 'amount_payed', 'date_paid', 'speed', 'customer_id', 'project_id');

        $validator = Validator::make($data, [
            'brief_id' => 'exists:project_briefs,id',
            'date' => 'required|date',
            'discount_percent' => 'required|numeric|between:0,99',
            'line_items' => 'array',
            'speeds' => 'array',
            'upfront_percent' => 'required|numeric|between:0,99',
            'users_to_notify' => 'array'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $data['date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $data['date'])->format('Y-m-d');
        $invoice->update($data);

        return $this->respondWithData($invoice->toArray());
    }

    /**
     * @Middleware("admin_auth")
     * @Delete("api/projects/{projects}/invoices/{invoices}")
     * @param $projectId
     * @param $invoiceId
     * @return mixed
     */
    public function delete($projectId, $invoiceId)
    {
        $project = Project::findOrFail($projectId);

        $invoice = $project->invoices()->findOrFail($invoiceId);
        if (! $invoice->isDeletable()) {
            return $this->respondWithError('Invoice with status '.$invoice->status.' can not be deleted');
        }

        $invoice->delete();

        $this->respondWithSuccess();
    }

    /**
     * @Post("api/projects/{projects}/invoices/{invoices}/send-to-client")
     * @param $projectId
     * @param $invoiceId
     * @return mixed
     */
    public function sendToClient($projectId, $invoiceId)
    {
        // add additional validation

        $project = Project::findOrFail($projectId);
        $invoice = $project->invoices()->findOrFail($invoiceId);
        $invoice->status = 'sent';
        $invoice->save();

        return $this->respondWithData($invoice->toArray());
    }

    /**
     * @Post("api/projects/{projects}/invoices/{invoices}/set-speed")
     * @param $projectId
     * @param $invoiceId
     */
    public function setSpeed($projectId, $invoiceId)
    {
        $speed = Input::get('speed') ?: 0;

        $project = Project::findOrFail($projectId);
        $invoice = $project->invoices()->findOrFail($invoiceId);
        $invoice->speed = $speed;
        $invoice->save();

        return $this->respondWithData($invoice->toArray());
    }

    /**
     * @Post("api/projects/{projects}/invoices/{invoices}/payment")
     * @param $projectId
     * @param $invoiceId
     * @return mixed
     */
    public function makePayment($projectId, $invoiceId)
    {
        $data = Input::all();

        $validator = Validator::make($data, [
            'type' => 'required|in:deposit,final'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $project = Project::findOrFail($projectId);

        /** @var Invoice $invoice */
        $invoice = $project->invoices()->findOrFail($invoiceId);
        $payments = $invoice->payments;

        $user = \Auth::user();
        InvoicePayment::unguard();
        $payment = InvoicePayment::firstOrNew([
            'invoice_id' => $invoice->id,
            'code' => $data['type'],
        ]);
        InvoicePayment::reguard();

        if ($payment->stripe_transaction_id) {
            $this->respondWithError('Payment has been already made. Please, refresh the page to see the update.');
        }

        switch ($data['type']) {
            case 'deposit':
                $status = 'deposit_paid';
                $code = 'deposit';
                $amount = $invoice->depositAmount * 100;
                $description = "Code My View Invoice #$invoice->id Deposit Payment";
                break;
            case 'final':
                $status = 'paid';
                $code = 'final';
                $amount = $invoice->finalAmount * 100;
                $description = "Code My View Invoice #$invoice->id Payment";
                break;
        }

        try {
            $options = [
                'description' => $description
            ];

            if ($data['token']) {
                $options['source'] = $data['token'];
            } else {
                $options['customer'] = $user->stripe_id;
            }

            $charge = $user->charge($amount, $options);

            $payment->stripe_transaction_id = $charge->id;
            $payment->amount = $amount;
            $payment->code = $code;
            $payment->payer_id = \Auth::user()->id;
            $payment->save();

            $invoice->status = $status;
            $invoice->save();
        } catch (\Exception $e) {
            //
            return $this->respondWithError('The transaction has been declined');
        }

        return $this->show($project->id, $invoice->id);
    }

    /**
     * @param array $data
     */
    public function validateInvoice(array $data)
    {

    }

}
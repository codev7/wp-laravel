@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">


    <div class="col-md-12" data-controller="project/invoice-edit" state="{{ json_encode(['invoice' => $invoice->toArray(), 'project' => $project->toArray()]) }}" v-cloak>
        
        <div class="panel panel-default panel-profile brief-panel">

            <div class="panel-body">
                
                <div><a data-pjax href="{{ route('project.invoices', ['slug' => $project->slug]) }}" class="text-muted"><i class="fa fa-arrow-left"></i> Back to all invoices</a></div>

                <br />
                <form action="">
                <div class="row">
                        
                    <div class="col-sm-9">

                        <div class="form-group">
                            <label>Is this invoice related to a developer brief?</label>

                            <select class="form-control" v-model="invoice.brief_id">
                                <option value="">Not related to a brief</option>
                                @foreach ($project->briefs as $brief)
                                    <option value="{{ $brief->id }}">{{ $brief->text['brief_type'] }} ({{ $brief->created_at->format('m/d/Y') }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">

                            <label>Send Invoice To</label>

                            <select class="form-control" multiple v-model="invoice.users_to_notify">
                                @foreach ($project->team->users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                            <p class="help-block">The people you select here will receive a notification about this invoice and any associated project briefs.  The invoice will still be visible to all members of this project - but if you do not select a user here, they will not receive an email notification about the invoice or brief.</p>
                        </div>


                        <div class="form-group">
                            <label for="discount_amount">Discount Percent</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="discount_amount" placeholder="Discount Amount" max="99"
                                       v-model="invoice.discount_percent">
                                <div class="input-group-addon">%</div>
                            </div>
                            <p class="help-block">Enter a percent amount that you want to discount off the invoice.</p>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Invoice Date</label>

                                    <input type="text" data-provide="datepicker" class="form-control"
                                           v-model="invoice.date">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Deposit Required</label>

                                    <div class="input-group">
                                        <input type="number" class="form-control" id="deposit_amount" placeholder="50%" max="99"
                                               v-model="invoice.upfront_percent">
                                        <div class="input-group-addon">%</div>
                                    </div>

                                    <p class="help-block">This is the amount we will require to be paid up front before the project will enter development.</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Line Items</label>

                            <table class="table table-striped table-bordered m-b-sm table-middle">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th style="width: 15%">Unit Cost</th>
                                        <th>Qty</th>
                                        <th class="text-right" style="width: 12%">Line Total</th>
                                        <th style="width: 5%"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(index, item) in invoice.line_items">
                                        <td>
                                            <input type="text" placeholder="A short description" class="form-control input-sm m-a-0"
                                                   v-model="item.description" />
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-addon">$</div>
                                                <input type="text" placeholder="100.00" class="form-control input-sm  m-a-0"
                                                       v-model="item.price" />
                                            </div>
                                        </td>
                                        <td>
                                            <select class="form-control input-sm  m-a-0" v-model="item.quantity">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </td>
                                        <td class="text-right">$@{{ item.quantity * item.price }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-xs btn-block btn-danger" v-on:click.prevent="removeLineItem(index)"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td  style="border-right: none">
                                            <a href="#" class="btn btn-primary btn-xs" v-on:click.prevent="addLineItem()"><i class="fa fa-plus"></i> Add Line Item</a>
                                        </td>
                                        <td style="border-left: none" colspan="2" class="text-right">Subtotal:</td>
                                        <td colspan="2">$@{{ subTotal }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Discount:</td>
                                        <td colspan="2"><em>-$@{{ discount }}</em></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Grand Total:</td>
                                        <td colspan="2"><strong>$@{{ grandTotal }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

                        <div class="clearfix"></div>

                        <hr />

                        <div class="form-group">
                            <label>Guaranteed Delivery Dates</label>

                            <table class="table table-striped table-bordered m-b-sm table-middle">
                                <thead>
                                    <tr>
                                        <th>Speed</th>
                                        <th>Enabled?</th>
                                        <th style="width: 30%">Delivery Date</th>
                                        <th style="width: 15%">Cost Multiplier</th>
                                        <th class="text-right" style="width: 12%">Total Cost</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(i, speed) in invoice.speeds">
                                        <td><h4 class="m-a-0 p-a-0">@{{ speed.title }}<br /><small class="text-muted">@{{ speed.timeframes }}</small></h4></td>
                                        <td><input type="checkbox" v-model="speed.enabled"></td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <input type="text" placeholder="guaranteed delivery date" data-provide="datepicker" class="form-control input-sm  m-a-0"
                                                       v-model="speed.delivery_date" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">

                                                <input type="text" v-bind:disabled="i == 0" placeholder="100" class="form-control input-sm  m-a-0"
                                                       v-model="speed.multiplier"/>
                                                <div class="input-group-addon">%</div>

                                            </div>
                                        </td>

                                        <td class="text-right">$@{{ Math.ceil(grandTotal * (speed.multiplier / 100)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="well well-small m-b-sm">
                            <button type="submit" class="btn btn-success btn-block"
                                    v-submit="sendingNotifications"
                                    v-on:click.prevent="sendEmailNotifications">Send Email Notification</button>

                            @if ($invoice->exists)
                            <button v-if="invoice.status == 'draft'" type="submit" class="btn btn-info btn-block"
                                    v-submit="sendingToClient"
                                    v-on:click.prevent="sendToClient">Send to Client</button>

                                <button v-if="invoice.status != 'draft'" class="btn btn-info btn-block"
                                        disabled>Is Sent to Client</button>
                            @endif

                            <button v-if="invoice.status == 'draft' || !invoice.id" type="button" class="btn btn-default-outline btn-block"
                                    v-submit="savingInvoice"
                                    v-on:click.prevent="saveAsDraft">Save as Draft
                            </button>

                            <button v-if="invoice.status != 'draft' && invoice.id" type="button" class="btn btn-default-outline btn-block"
                                    v-submit="savingInvoice"
                                    v-on:click.prevent="saveAsDraft">Save
                            </button>
                            
                        </div>

                        <a v-if="invoice.id" href="#" class="btn btn-danger-outline btn-xs pull-right"
                           v-submit="deletingInvoice"
                           v-on:click.prevent="deleteInvoice">Delete Invoice</a>

                    </div>
                </div><!--row-->
                </form> 
         

            </div>

        </div><!--panel-->
        
        
    </div>
@endsection
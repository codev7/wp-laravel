@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">


    <div class="col-sm-12">
        <p class="m-b-sm"><a data-pjax href="{{ route('project.invoices', ['slug' => $project->slug]) }}" class="text-muted"><i class="fa fa-arrow-left"></i> Back to all invoices</a></p>

    </div>

    <div class="col-md-8">
        
        

        <div class="panel panel-default invoice-panel">

            <div class="panel-body">
                
                <div class="row">
                    <div class="col-sm-12">

                        <div class="alert alert-info">This project requires a 50% deposit before it will be moved into development.  Please select a delivery option below to start your project.</div>

                        <div class="alert alert-success">This invoice was paid in full 5 days ago.</div>

                        <div class="alert alert-warning">We have received your deposit and your project has entered development.</div>
                        <br />
                        <p class="logo-bg">
                            <strong>Code My Views Inc.</strong><br />
                            2028 E Ben White Blvd Ste 240<br />
                            Box 9450<br />
                            Austin, TX 78741
                        </p>
                    </div>



                    <div class="col-sm-6">

                        <p class="m-t-lg">
                            Team Name Inc.<br />
                            James Jiggins
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-striped table-condensed m-t-lg">
                            <tbody>
                                <tr>
                                    <td>Invoice #</td>
                                    <td>20184512</td>
                                </tr>
                                <tr>
                                    <td>Invoice Date</td>
                                    <td>August 31, 2015</td>
                                </tr>
                            </tbody>
                        </table>

                        
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12">
                        <table class="table table-bordered m-b-sm table-middle table-white">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th style="width: 15%">Unit Cost</th>
                                    <th>Qty</th>
                                    <th class="text-right" style="width: 12%">Line Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Some random lorem ipsum text here</td>
                                    <td>
                                        $25.00
                                    </td>
                                    <td class="text-center">
                                        4
                                    </td>
                                    <td class="text-right">100.00</td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td  style="border-right: none"></td>
                                    <td style="border-left: none" colspan="2" class="text-right">Subtotal:</td>
                                    <td colspan="2" class="text-right">$100.00</td>
                                </tr>
                            </tfoot>
                        </table>


                        <h5>Payments</h5>
                        <table class="table table-bordered table-middle table-white table-condensed">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Deposit</td>
                                    <td>$500.00</td>
                                    <td>5 days ago</td>
                                </tr>
                                <tr>
                                    <td>Final Payment</td>
                                    <td>$500.00</td>
                                    <td><em>not yet paid</em>&nbsp;&nbsp;&nbsp;<a href="#modal-pay-invoice" data-toggle="modal" class="btn btn-xs btn-success">Pay Now</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


                
                

            </div>

            

        </div><!--panel-->
    </div>

    <div class="col-sm-4">
        <div class="well well-small">
            <table class="table table-bordered m-b-sm table-middle table-white">
                <tr>
                    <td class="text-right">Subtotal:</td>
                    <td class="text-right">$100.00</td>
                </tr>

                <tr>
                    <td class="text-right">Expedited Delivery Speed:</td>
                    <td class="text-right">$400</td>
                </tr>

                <tr>
                    <td class="text-right">Discount (25%):</td>
                    <td class="text-right"><em>-$25.00</em></td>
                </tr>
                
                <tr>
                    <td class="text-right">Grand Total: <small class="text-muted">Standard turnaround time <a href="#delivery-date-selector" data-toggle="modal">change delivery speed</a></small></td>
                    <td class="text-right"><strong>$75.00</strong></td>
                </tr>
            </table>

            <a href="#delivery-date-selector" data-toggle="modal" class="btn btn-lg btn-success btn-block">Select Delivery Date</a>
            <a href="#modal-pay-invoice" data-toggle="modal" class="btn btn-lg btn-success btn-block">Pay Deposit</a>
            <a href="#modal-pay-invoice" data-toggle="modal" class="btn btn-lg btn-success btn-block">Pay Balance of $500</a>
        </div>

        <div class="panel panel-default m-b-md text-center">
            <div class="panel-body">
                <h5 class="m-t-0">This invoice is for the following development brief:</h5>

  

                <ul class="media-list media-list-stream">
                    <li class="media m-b">

                        <div class="media-body">
                            <strong>PSD to HTML Project</strong>
                            <p class="text-muted m-a-0">Name of Team</p>
                            <div class="media-body-actions">
                                <button class="btn btn-primary-outline btn-xs">
                                <i class="fa fa-search"></i> View Brief</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>


        </div>

        <a href="#" class="btn btn-warning-outline btn-xs pull-right"><i class="fa fa-edit"></i> Edit Invoice</a>
    </div>
    @include('modals/delivery-date-selector')
    @include('modals/payment-info')
</div>

@endsection
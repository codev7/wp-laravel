@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">


    <div class="col-md-12">
        
        <div class="panel panel-default panel-profile brief-panel">

            <div class="panel-body">
                
                <div><a data-pjax href="{{ route('project.invoices', ['slug' => $project->slug]) }}" class="text-muted"><i class="fa fa-arrow-left"></i> Back to all invoices</a></div>

                <br />
                <form action="">
                <div class="row">
                        
                    <div class="col-sm-9">

                        

                            <div class="form-group">
                                <label>Is this invoice related to a developer brief?</label>

                                <select class="form-control">
                                    <option value="">Not related to a brief</option>
                                    <option value="brief_id">Some brief name</option>
                                    <option value="brief_id">Some brief name</option>
                                    <option value="brief_id">Some brief name</option>
                                    <option value="brief_id">Some brief name</option>
                                    <option value="brief_id">Some brief name</option>
                                </select>
                            </div>

                            <div class="form-group">

                                <label>Send Invoice To</label>

                                <select class="form-control" multiple>
                                    <option value="">teammember@email.com</option>
                                    <option value="">teammember@email.com</option>
                                    <option value="">teammember@email.com</option>
                                    <option value="">teammember@email.com</option>
                                    <option value="">teammember@email.com</option>
                                </select>

                                <p class="help-block">The people you select here will receive a notification about this invoice and any associated project briefs.  The invoice will still be visible to all members of this project - but if you do not select a user here, they will not receive an email notification about the invoice or brief.</p>
                            </div>
                                                

                            <div class="form-group">
                                <label for="discount_amount">Discount Percent</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="discount_amount" placeholder="Discount Amount">
                                    <div class="input-group-addon">%</div>
                                </div>
                                <p class="help-block">Enter a percent amount that you want to discount off the invoice.</p>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Invoice Date</label>

                                        <input type="text" data-provide="datepicker" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Deposit Required</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control" id="discount_amount" placeholder="50%">
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
                                        <tr>
                                            <td><input type="text" placeholder="A short description" class="form-control input-sm m-a-0" /></td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="text" placeholder="100.00" class="form-control input-sm  m-a-0" />
                                                    
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm  m-a-0">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                    <option>6</option>
                                                    <option>7</option>
                                                    <option>8</option>
                                                    <option>9</option>
                                                    <option>10</option>
                                                </select>
                                            </td>
                                            <td class="text-right">0.00</td>
                                            <td class="text-center"><a href="#" class="btn btn-xs btn-block btn-danger"><i class="fa fa-times"></i></a></td>
                                        </tr>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td  style="border-right: none"><a href="#" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add Line Item</a></td>
                                            <td style="border-left: none" colspan="2" class="text-right">Subtotal:</td>
                                            <td colspan="2">$100.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">Discount:</td>
                                            <td colspan="2"><em>-$25.00</em></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">Grand Total:</td>
                                            <td colspan="2"><strong>$75.00</strong></td>
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
                                        <tr>
                                            <td><h4 class="m-a-0 p-a-0">Standard Turnaround<br /><small class="text-muted">5-10 business days</small></h4></td>
                                            <td><input type="checkbox" checked="checked"></td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                    <input type="text" placeholder="guaranteed delivery date" data-provide="datepicker" class="form-control input-sm  m-a-0" />

                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    
                                                    <input type="text" disabled="disabled" placeholder="0" value="0"  class="form-control input-sm  m-a-0" />
                                                    <div class="input-group-addon">%</div>

                                                </div>
                                            </td>
                                            <td class="text-right">75.00</td>
                                        </tr>

                                        <tr>
                                            <td><h4 class="m-a-0 p-a-0">Rush Turnaround<br /><small class="text-muted">3-5 business days</small></h4></td>
                                            <td><input type="checkbox" checked="checked"></td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                    <input type="text" placeholder="guaranteed delivery date" data-provide="datepicker" class="form-control input-sm  m-a-0" />

                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    
                                                    <input type="text" placeholder="20"  class="form-control input-sm  m-a-0" />
                                                    <div class="input-group-addon">%</div>

                                                </div>
                                            </td>
                                            <td class="text-right">0.00</td>
                                        </tr>

                                        <tr>
                                            <td><h4 class="m-a-0 p-a-0">Urgent Turnaround<br /><small class="text-muted">1-3 business days</small></h4></td>
                                            <td><input type="checkbox" checked="checked"></td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                    <input type="text" placeholder="guaranteed delivery date" data-provide="datepicker" class="form-control input-sm  m-a-0" />

                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    
                                                    <input type="text" placeholder="20"  class="form-control input-sm  m-a-0" />
                                                    <div class="input-group-addon">%</div>

                                                </div>
                                            </td>
                                            <td class="text-right">0.00</td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="well well-small m-b-sm">
                            <button type="submit" class="btn btn-success btn-block">Send Email Notification</button>

                            <br />

                            <button type="button" class="btn btn-default-outline btn-block">Save as Draft</button>

                            
                        </div>

                        <a href="#" class="btn btn-danger-outline btn-xs pull-right">Delete Invoice</a>

                    </div>
                </div><!--row-->
                </form> 
         

            </div>

        </div><!--panel-->
        
        
    </div>
@endsection
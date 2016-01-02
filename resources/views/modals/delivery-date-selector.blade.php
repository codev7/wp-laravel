<div class="modal fade" id="delivery-date-selector">
  <div class="modal-dialog modal-lg">
    <div class="modal-content special-blue-bg">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">

            <div class="row flat">

                <div class="col-sm-12 text-center">
                    <h3>Choose Delivery Date:</h3>
                    <p>By choosing a delivery date below, you are agreeing to move the project into the development phase.</p>
                </div>
                <div class="col-md-4 col-xs-12">

               
                    <ul class="plan plan1  ">
                        <li class="plan-name">
                            Standard
                        </li>


                        <li class="plan-price">
                            <h3 class="black">$@{{ subtotal * (invoice.speeds[0].multiplier/100) }}</h3>
                        </li>
                        <li><p class="black">Guaranteed by end of day @{{ invoice.speeds[0].delivery_date | mdYtoMDoY }}<br /><small class="text-muted">(@{{ invoice.speeds[0].delivery_date | mdYtoReadable }})</small></p></li>
                        <li class="plan-action">
                            <a 
                                href="#"
                                class="btn btn-default-outline  btn-lg"
                                v-submit="settingSpeed"
                                v-on:click.prevent="setSpeed(0)">
                                Select
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-xs-12">
                    <ul class="plan plan2  featured">
                        <li class="plan-name">
                            Expedited
                        </li>
                        <li class="plan-price">
                            <h3 class="black">$@{{ subtotal * (invoice.speeds[1].multiplier/100) }}</h3>
                        </li>

                        <li><p class="black">Guaranteed by end of day @{{ invoice.speeds[1].delivery_date | mdYtoMDoY }}<br /><small class="text-muted">(@{{ invoice.speeds[2].delivery_date | mdYtoReadable }})</small></p></li>
                        <li class="plan-action">
                            <a 
                                href="#"
                                class="btn btn-success  btn-lg"
                                v-submit="settingSpeed"
                                v-on:click.prevent="setSpeed(1)">
                                Select
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-xs-12">

               
                    <ul class="plan plan3">
                        <li class="plan-name">
                            Urgent
                        </li>
                        <li class="plan-price">
                            <h3 class="black">$@{{ subtotal * (invoice.speeds[2].multiplier/100) }}</h3>
                        </li>

                        <li><p class="black">Guaranteed by end of day @{{ invoice.speeds[2].delivery_date | mdYtoMDoY }}<br /><small class="text-muted">(@{{ invoice.speeds[2].delivery_date | mdYtoReadable }})</small></p></li>
                        <li class="plan-action">
                            <a href="#" class="btn btn-default-outline  btn-lg"
                               v-submit="settingSpeed"
                               v-on:click.prevent="setSpeed(2)">
                                Select
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-12 text-center">
                    
                    <br />

                    <p class="m-b-lg">Please understand that once work begins, any additions to the project, or changes in scope will result in a delay in your agreed upon delivery time. Once a project has been moved into production, it is impossible to make changes to it without influencing delivery dates.</p>
                </div>
            </div>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
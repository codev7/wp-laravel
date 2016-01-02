@section('scripts')
    <script src="https://js.stripe.com/v2/"></script>

    <script>
        Stripe.setPublishableKey('{{ config('services.stripe.key') }}');
    </script>
@endsection

<div class="modal fade in" id="modal-pay-invoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <div class="modal-body">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table" style="width: 100%">
                        <div class="row display-tr">
                            <h3 class="panel-title display-td">$@{{ invoice.status == 'sent' ? (invoice.depositAmount + ' deposit') : invoice.finalAmount }}</h3>
                            <div class="display-td">
                                <img class="img-responsive pull-right" src="{{ asset('images/accepted.png') }}" alt="Accepted Credit Cards">
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" novalidate="novalidate" id="invoice-payment-form">
                            @if (Auth::user()->last_four)
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="email">Pay With</label>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="pre-saved" v-model="paymentMethod">
                                                Pre-saved Card **** **** **** {{ Auth::user()->last_four }}
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="one-time" v-model="paymentMethod">
                                                Another Card
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            @endif

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="cardNumber">CARD NUMBER</label>
                                        <div class="input-group input-group-lg">
                                            <input type="tel" class="form-control input-lg" name="cardNumber" placeholder="Valid Card Number" autocomplete="cc-number" required=""
                                                   v-bind:disabled="paymentMethod == 'pre-saved'"
                                                    data-stripe="number">
                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-md-3">
                                    <div class="form-group">
                                        <label for="cardExpiry">Exp Month</label>
                                        <select type="text" class="form-control" placeholder="MONTH" required=""
                                                v-bind:disabled="paymentMethod == 'pre-saved'"
                                                data-stripe="exp-month">
                                            <option value="01">Jan</option>
                                            <option value="02">Feb</option>
                                            <option value="03">Mar</option>
                                            <option value="04">Apr</option>
                                            <option value="05">May</option>
                                            <option value="06">Jun</option>
                                            <option value="07">Jul</option>
                                            <option value="08">Aug</option>
                                            <option value="09">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-md-4">
                                    <div class="form-group">
                                        <label for="cardExpiry">Exp Year</label>
                                        <select type="text" class="form-control" name="exp_year" placeholder="YEAR" required=""
                                                v-bind:disabled="paymentMethod == 'pre-saved'"
                                                data-stripe="exp-year">
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-5 pull-right">
                                    <div class="form-group">
                                        <label for="cardCVC">CV CODE</label>
                                        <input type="tel" class="form-control" name="cardCVC" placeholder="CVC" autocomplete="cc-csc" required=""
                                               v-bind:disabled="paymentMethod == 'pre-saved'"
                                                data-stripe="cvc">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="couponCode">COUPON CODE</label>
                                        <input type="text" class="form-control" name="couponCode">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-success btn-lg btn-block" type="submit"
                                            v-submit="submittingPayment"
                                            v-on:click.prevent="submitPayment">Submit Payment</button>
                                </div>
                            </div>
            
                        </form>
                    </div>
                </div>

                <img src="{{ asset('images/stripe.jpg') }}" style="width: 80px" alt="Secure Payments By Stripe">
            </div>
        </div>
    </div>
</div>
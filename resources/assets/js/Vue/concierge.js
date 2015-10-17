if(document.querySelector('#order-concierge'))
{
    new Vue({
        el: '#order-concierge',

        data: {

            payment_successful: false,
            modal: {

                title: null,
                text: null,
                button: null,
                plan_id: null
            },

            loaded: false

        },
        computed: {},

        ready: function() {


            $('input[name=cardNumber]').payment('formatCardNumber');
            $('input[name=cardCVC]').payment('formatCardCVC');

            this.$set('form', $('#payment-form'));


            this.form.find('[type=submit]').prop('disabled', true);


           var that = this;
            var readyInterval = setInterval(function() {
                if (that.paymentFormReady()) {
                    that.form.find('[type=submit]').prop('disabled', false);
                    clearInterval(readyInterval);
                }
            }, 250);

            this.setDefaults();
            //this.fetchPortfolioItems();
            //CMV.trackEvent('misc','Viewed Portfolio Page',0);
        },

        methods: {


            setDefaults: function()
            {
                /* Form validation using Stripe client-side validation helpers */
                jQuery.validator.addMethod("cardNumber", function(value, element) {
                    return this.optional(element) || Stripe.card.validateCardNumber(value);
                }, "Please specify a valid credit card number.");


                jQuery.validator.addMethod("cardCVC", function(value, element) {
                    return this.optional(element) || Stripe.card.validateCVC(value);
                }, "Invalid CVC.");

                validator = this.form.validate({
                    rules: {
                        cardNumber: {
                            required: true,
                            cardNumber: true            
                        },
                        exp_month: {
                            required: true
                        },
                        exp_year: {
                            required: true
                        },
                        cardCVC: {
                            required: true,
                            cardCVC: true
                        }
                    },
                    highlight: function(element) {
                        $(element).closest('.form-control').removeClass('success').addClass('error');
                    },
                    unhighlight: function(element) {
                        $(element).closest('.form-control').removeClass('error').addClass('success');
                    },
                    errorPlacement: function(error, element) {
                        $(element).closest('.form-group').append(error);
                    }
                });
            }, 

            paymentFormReady: function() {
                if (this.form.find('[name=cardNumber]').hasClass("success") &&
                    this.form.find('[name=exp_month]').hasClass("success") &&
                    this.form.find('[name=exp_year]').hasClass("success") &&
                    this.form.find('[name=cardCVC]').val().length > 1) {
                    return true;
                } else {
                    return false;
                }
            },

            launchStripeModal: function(e, title, text, button, plan_id)
            {   

                

                var btn = $(e.target);
                

                this.modal = {
                    title: title,
                    text: text,
                    button: button,
                    plan_id: plan_id
                };


                if($(window).width() < 767)
                {   

                    CMV.trackEvent('concierge',text + ' button click',0);
                    CMV.trackEvent('concierge','Subscribe Button Clicked Mobile Device',0);

                     $('#modal-concierge-subscribe').show().css('opacity',1);
                }
                else
                {

                    CMV.trackEvent('concierge',text + ' button click',0);
                    CMV.trackEvent('concierge','Subscribe Button Clicked Desktop',0);
                    $('#modal-concierge-subscribe').modal('show');
                    e.preventDefault();
                }
               

            },


            payWithStripe: function(e)
            {
                e.preventDefault();

                var $form = this.form;

                /* Visual feedback */
                $form.find('[type=submit]').html('Validating <i class="fa fa-spinner fa-pulse"></i>');

                var PublishableKey = document.querySelector('#stripe-token').getAttribute('content');
                Stripe.setPublishableKey(PublishableKey);
                
                /* Create token */
                var ccData = {
                    number: $form.find('[name=cardNumber]').val().replace(/\s/g,''),
                    cvc: $form.find('[name=cardCVC]').val(),
                    exp_month: $form.find('[name=exp_month]').val(), 
                    exp_year: $form.find('[name=exp_year]').val()
                };
                
                 CMV.trackEvent('concierge','Stripe Payment Attempt',0);
                var that = this;

                Stripe.card.createToken(ccData, function stripeResponseHandler(status, response) {
                    if (response.error) {
                        /* Visual feedback */
                        $form.find('[type=submit]').html('Try again');
                        /* Show Stripe errors on the form */
                        $form.find('.payment-errors').text(response.error.message);
                        $form.find('.payment-errors').closest('.row').show();

                         CMV.trackEvent('concierge','Stripe Payment Error',0);

                    } else {
                        /* Visual feedback */
                        $form.find('[type=submit]').html('Processing <i class="fa fa-spinner fa-pulse"></i>');
                        /* Hide Stripe errors on the form */
                        $form.find('.payment-errors').closest('.row').hide();
                        $form.find('.payment-errors').text("");
                        // response contains id and card, which contains additional card details            
                        

                         CMV.trackEvent('concierge','Stripe Payment Token Success',0);
                        var token = response.id;
                        
                        // AJAX - you would send 'token' to your server here.
                        that.processPayment(token);
                    }
                });
            },

            processPayment: function(token)
            {

                var formData = {


                    token: token,
                    plan: this.modal.plan_id,
                    email: $('input[name=email]').val(),
                    couponCode: $('input[name=couponCode]').val(),

                };


                var that = this;
                
                that.$http.post('/concierge/subscribe', formData, function(data, status, request)
                {   

                    $form = that.form;

                    $form.find('[type=submit]').html('Payment successful <i class="fa fa-check"></i>').prop('disabled', true);


                    switch(that.modal.plan_id)
                    {


                        case 'WP-CONCIERGE-BASIC':
                            var value = 500 * 3;
                        break;


                        case 'WP-CONCIERGE-PREMIUM':

                            var value = 750 * 3;

                        break;


                        case 'WP-CONCIERGE-TRAFFIC':

                            var value = 1500 * 3;

                        break;

                    }

                    var shareASaleTracker =  "<img src='https://shareasale.com/sale.cfm?amount=" +  value / 3 + "&tracking=" + formData.email + "&transtype=sale&merchantID=60950' width='1' height='1'>";

                    $('#payment-form').append(shareASaleTracker);

                    /* Perfect Audience Tracking */
                    _pa.revenue = value;
                    _pa.productId = that.modal.plan_id; 
                    _pq.push(['track', 'concierge_signup']);

                    CMV.trackEvent('concierge','Customer Subscribed',value);

                    setTimeout(function()
                    {

                        $('#modal-concierge-subscribe').modal('hide');

                        $.scrollTo('#order-concierge',{

                            duration: 500,
                            offset: {
                                top: -110
                            }

                        });

                        that.payment_successful = true;

                    },1000);


                }).error(function(data, status, request)
                {


                    var $form = that.form;

                    $form.find('[type=submit]').html('There was a problem').removeClass('success').addClass('error');
                       
                    $form.find('.payment-errors').text('Try refreshing the page and trying again.');
                    $form.find('.payment-errors').closest('.row').show();

                });
            }
        }
    });    
}

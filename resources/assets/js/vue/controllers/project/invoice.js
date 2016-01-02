var notify = require('./../../../misc/notify');

export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            invoice: {payments: []},
            payingForInvoice: false,
            settingSpeed: false,
            submittingPayment: false,
            paymentMethod: 'one-time'
        }
    },

    ready() {
        this.invoice = this.state.invoice;
        this.project = this.state.project;
    },

    computed: {
        depPayment() {
            var p = _.findWhere(this.invoice.payments, {code: 'deposit'});
            return p === undefined ? null : p;
        },
        finalPayment() {
            var p = _.findWhere(this.invoice.payments, {code: 'final'});
            return p === undefined ? null : p;
        }
    },

    methods: {
        openSpeedModal() {
            $("#delivery-date-selector").modal();
        },
        setSpeed(index) {
            this.settingSpeed = true;
            this.$http.post(`/api/projects/${this.project.id}/invoices/${this.invoice.id}/set-speed`, {speed: index}, (res) => {
                this.invoice = res.data;
                $("#delivery-date-selector").modal('hide');
            }).always(() => {
                this.settingSpeed = false;
            });

        },
        openPaymentModal() {
            $('[data-stripe]').val('');
            this.paymentMethod = 'one-time';
            $("#modal-pay-invoice").modal();
        },
        submitPayment() {
            this.submittingPayment = true;
            if (this.paymentMethod == 'pre-saved') {
                this.attemptPay(null);
            } else {
                this.payWithOneTimeToken();
            }
        },
        payWithOneTimeToken() {
            Stripe.card.createToken($("#invoice-payment-form"), (status, res) => {
                if (res.error) {
                    notify.error(res.error.message);
                    this.submittingPayment = false;
                } else {
                    this.attemptPay(res.id);
                }
            });
        },
        attemptPay(token) {
            //token [ pre-saved / returned_by_stripe_api_call ]
            var payload = { token: token, type: (this.invoice.status == 'sent' ? 'deposit' : 'final') };

            this.$http.post(`/api/projects/${this.project.id}/invoices/${this.invoice.id}/payment`, payload, (res) => {
                this.invoice = res.data;
            }).always(() => {
                this.submittingPayment = false;
            });
        }
    }
});
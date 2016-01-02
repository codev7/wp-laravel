var notify = require('./../../../misc/notify');

export default Vue.extend({

    mixins: [require('./../../mixins/hasState')],

    data() {
        return {
            invoice: {
                line_items: [],
                upfront_percent: 20,
                invoice_date: '',
                discount_percent: 0
            },
            savingInvoice: false,
            deletingInvoice: false,
            sendingToClient: false,
            sendingNotifications: false
        }
    },

    ready() {
        this.setInvoice(this.state.invoice);
        this.project = this.state.project;
    },

    computed: {
        subTotal() {
            return _.reduce(this.invoice.line_items, (total, item) => {
                return total + item.quantity * item.price;
            }, 0);
        },
        discount() {
            return Math.ceil(this.subTotal  - (this.subTotal * ((100 - this.invoice.discount_percent)/100) ));
        },
        grandTotal() {
            return this.subTotal - this.discount;
        }
    },

    methods: {

        setInvoice(invoice) {
            var date = invoice.date;
            invoice.date = (date ? moment(date) : moment()).format('M/D/YYYY');

            this.invoice = invoice;
        },

        addLineItem() {
            this.invoice.line_items.push({
                name: '',
                description: '',
                quantity: 1,
                price: 10
            });
        },

        removeLineItem(index) {
            this.invoice.line_items = _.without(this.invoice.line_items, this.invoice.line_items[index]);
        },

        saveAsDraft() {
            this.savingInvoice = true;
            if (this.invoice.id == undefined) {
                this.$http.post(`/api/projects/${this.project.id}/invoices`, this.invoice, (res) => {
                    this.setInvoice(res.data);
                    window.location.replace(`/project/${this.project.slug}/invoices/${this.invoice.id}/edit`);
                })
                    .always(() => {
                        this.savingInvoice = false;
                    });
            } else {
                this.$http.put(`/api/projects/${this.project.id}/invoices/${this.invoice.id}`, this.invoice, (res) => {
                    this.setInvoice(res.data);
                })
                    .always(() => {
                        this.savingInvoice = false;
                    });
            }
        },

        deleteInvoice() {
            this.deletingInvoice = true;
            this.$http.delete(`/api/projects/${this.project.id}/invoices/${this.invoice.id}`, (res) => {
                window.location.replace(`/project/${this.project.slug}/invoices`);
            })
                .always(() => {
                    this.deletingInvoice = false;
                });
        },

        sendToClient() {
            this.sendingToClient = true;
            this.$http.post(`/api/projects/${this.project.id}/invoices/${this.invoice.id}/send-to-client`, this.invoice, (res) => {
                this.setInvoice(res.data);
            }).always(() => {
                this.sendingToClient = false;
            });
        },

        sendEmailNotifications() {
            this.sendingNotifications = true;
            this.$http.post(`/api/projects/${this.project.id}/invoices/${this.invoice.id}/notify-users`, {users: this.invoice.users_to_notify}, (res) => {
                notify.success('Selected users have been notified about the invoice');
            }).always(() => {
                this.sendingNotifications = false;
            });
        }
    }

});
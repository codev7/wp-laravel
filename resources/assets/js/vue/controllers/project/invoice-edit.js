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
            sendingToClient: false
        }
    },

    ready() {
        this.invoice = this.state.invoice;
        this.project = this.state.project;
    },

    computed: {
        subtotal() {
            return _.reduce(this.invoice.line_items, (total, item) => {
                return total + item.quantity * item.price;
            }, 0);
        },
        discount() {
            return Math.ceil(this.subtotal  - (this.subtotal * ((100 - this.invoice.discount_percent)/100) ));
        },
        grandTotal() {
            return this.subtotal - this.discount;
        }
    },

    methods: {

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
                    this.invoice = res.data;
                    window.location.replace(`/project/${this.project.slug}/invoices/${this.invoice.id}/edit`);
                })
                    .always(() => {
                        this.savingInvoice = false;
                    });
            } else {
                this.$http.put(`/api/projects/${this.project.id}/invoices/${this.invoice.id}`, this.invoice, (res) => {
                    this.invoice = res.data;
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
                this.invoice = res.data;
            }).always(() => {
                this.sendingToClient = false;
            });
        }

    }

});
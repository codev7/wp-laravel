var controller = new Vue({
    data: {

        loaded: false

    },
    computed: {},

    ready: function() {

        this.fetchPortfolioItems();
        CMV.trackEvent('misc','Viewed Portfolio Page',0);
    },

    methods: {

        fetchPortfolioItems: function() {

            this.$http.get('/code/get', function(portfolioItems) {
                this.$set('portfolioItems', portfolioItems);
                this.loaded = true;
            });
        },

        openCodeModal: function(tab) {
            for(i=0;i<this.portfolioItems.length;i++)
            {

                if(this.portfolioItems[i].name == tab)
                {
                    this.$set('modal', this.portfolioItems[i]);
                }
            }


            $('#modal-portfolio')
                .modal('show')
                .on('shown.bs.modal',function(e)
                {

                    $('pre code').each(function(i, block) {
                        hljs.highlightBlock(block);
                    });


                    $(this).find('.tab-pane:first').addClass('active');

                });
        }
    }
});

export default controller;

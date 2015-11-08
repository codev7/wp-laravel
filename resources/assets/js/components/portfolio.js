Vue.component('cmv-portfolio', {
    /*
     * Bootstrap the component. Load the initial data.
     */
    ready: function () {
        this.fetchPortfolioItems();
        CMV.trackEvent('misc','Viewed Portfolio Page',0);
    },


    /*
     * Initial state of the component's data.
     */
    data: function () {
        return {
            loaded: false,
            portfolioItems: []
        };
    },


    events: {
        /*
         * Handle the "userRetrieved" event.
         */
        portfolioLoaded: function () {
            this.loaded = true;
        },

    },


    methods: {
        fetchPortfolioItems: function() {

            this.$http.get('/code/get', function(portfolioItems) {
                this.portfolioItems = portfolioItems;
                this.$dispatch('portfolioLoaded', team);
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
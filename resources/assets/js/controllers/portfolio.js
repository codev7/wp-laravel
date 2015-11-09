var controller = new Vue({

    /*
     * Bootstrap the component. Load the initial data.
     */
    ready() {
        this.fetchPortfolioItems();
        CMV.trackEvent('misc','Viewed Portfolio Page',0);
    },


    /*
     * Initial state of the component's data.
     */
    data() {
        return {
            loaded: false,
            portfolioItems: [],
            modal: {tabs: []}
        };
    },


    events: {
        /*
         * Handle the "userRetrieved" event.
         */
        portfolioLoaded() {
            //this.loaded  true;
        }

    },


    methods: {
        fetchPortfolioItems() {

            this.$http.get('/code/get', function(portfolioItems) {
                console.log(portfolioItems);
                this.portfolioItems = portfolioItems;
                this.loaded = true;

//                this.$dispatch('portfolioLoaded');
            });
        },

        openCodeModal(tab) {
            for(var i=0; i<this.portfolioItems.length; i++)
            {
                if(this.portfolioItems[i].name == tab)
                {   
                    this.modal = this.portfolioItems[i];
                }
            }


            $('#modal-portfolio').modal('show')
                .on('shown.bs.modal',function(e)
                {
                    $('pre code').each((i, block) => hljs.highlightBlock(block));
                    $(this).find('.tab-pane:first').addClass('active');
                });
        }
    }
});

export default controller;
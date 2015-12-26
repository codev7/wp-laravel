export default Vue.extend({

    /*
     * Bootstrap the component. Load the initial data.
     */
    ready() {
        this.fetchPortfolioItems();
        CMV.trackEvent(&#x27;misc&#x27;,&#x27;Viewed Portfolio Page&#x27;,0);
    },


    /*
     * Initial state of the component&#x27;s data.
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
         * Handle the &#x22;userRetrieved&#x22; event.
         */
        portfolioLoaded() {
            //this.loaded  true;
        }

    },


    methods: {
        fetchPortfolioItems() {
            this.$http.get(&#x27;/code/get&#x27;, function(portfolioItems) {
                this.portfolioItems = portfolioItems;
                this.loaded = true;
            });
        },

        openCodeModal(tab) {
            for(var i=0; i&#x3C;this.portfolioItems.length; i++)
            {
                if(this.portfolioItems[i].name == tab)
                {   
                    this.modal = this.portfolioItems[i];
                }
            }

            $(&#x27;#modal-portfolio&#x27;).modal(&#x27;show&#x27;)
                .on(&#x27;shown.bs.modal&#x27;,function(e)
                {
                    $(&#x27;pre code&#x27;).each((i, block) =&#x3E; hljs.highlightBlock(block));
                    $(this).find(&#x27;.tab-pane:first&#x27;).addClass(&#x27;active&#x27;);
                });
        }
    }
});
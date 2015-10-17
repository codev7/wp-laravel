new Vue({
    el: &#x27;#portfolio-items&#x27;,

    data: {

        loaded: false

    },
    computed: {},

    ready: function() {

        this.fetchPortfolioItems();
        CMV.trackEvent(&#x27;misc&#x27;,&#x27;Viewed Portfolio Page&#x27;,0);
    },

    methods: {

        fetchPortfolioItems: function() {

            this.$http.get(&#x27;/code/get&#x27;, function(portfolioItems) {
                this.$set(&#x27;portfolioItems&#x27;, portfolioItems);
                this.loaded = true;
            });
        },

        openCodeModal: function(tab) {
            for(i=0;i&#x3C;this.portfolioItems.length;i++)
            {

                if(this.portfolioItems[i].name == tab)
                {   
                    this.$set(&#x27;modal&#x27;, this.portfolioItems[i]); 
                }
            }


            $(&#x27;#modal-portfolio&#x27;)
                .modal(&#x27;show&#x27;)
                .on(&#x27;shown.bs.modal&#x27;,function(e)
                {

                    $(&#x27;pre code&#x27;).each(function(i, block) {
                        hljs.highlightBlock(block);
                    });        


                    $(this).find(&#x27;.tab-pane:first&#x27;).addClass(&#x27;active&#x27;);

                });
        }
    }
});
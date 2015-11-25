<script>
    UPLOADCARE_LOCALE = "en";
    UPLOADCARE_TABS = "file url gdrive dropbox";
    UPLOADCARE_PUBLIC_KEY = "{{ env('UPLOADCARE_PUBLIC_KEY') }}";
    UPLOADCARE_CDN_BASE = "{{ env('UPLOADCARE_CDN_BASE') }}";
    UPLOADCARE_MANUAL_START = true;
    UPLOADCARE_LOCALE_TRANSLATIONS = {
        buttons: {
            choose: {
                files: {
                    other: 'Upload Files'
                }
            }
        }
    };

</script>

<script charset="utf-8" src="//ucarecdn.com/widget/2.5.5/uploadcare/uploadcare.full.min.js"></script>

@if(isProduction())
<script type="text/javascript">
 var _chatlio=_chatlio||[];
!function(){var t=document.getElementById("chatlio-widget-embed");if(t&&window.React&&_chatlio.init)return void _chatlio.init(t,React);for(var e=function(t){return function(){_chatlio.push([t].concat(arguments))}},i=["configure","identify","track","show","hide","isShown","isOnline"],a=0;a<i.length;a++)_chatlio[i[a]]||(_chatlio[i[a]]=e(i[a]));var n=document.createElement("script"),c=document.getElementsByTagName("script")[0];n.id="chatlio-widget-embed",n.src="https://w.chatlio.com/w.chatlio-widget.js",n.async=!0,n.setAttribute("data-embed-version","1.3");
  
  n.setAttribute("data-widget-id","834c3106-e63f-4d4c-54c9-2c605e54ae4a");
  n.setAttribute("data-start-hidden", false);
  c.parentNode.insertBefore(n,c);
 }();
</script>

<script type="text/javascript">
  (function() {
    window._pa = window._pa || {};
    // _pa.orderId = "myOrderId"; // OPTIONAL: attach unique conversion identifier to conversions
    // _pa.revenue = "19.99"; // OPTIONAL: attach dynamic purchase values to conversions
    // _pa.productId = "myProductId"; // OPTIONAL: Include product ID for use with dynamic ads
    var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true;
    pa.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + "//tag.marinsm.com/serve/55750e6d5e02be6a8800003a.js";
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(pa, s);
  })();
</script>


<script src="//load.sumome.com/" data-sumo-site-id="cbd69eb33c6add8729a025e4b35f477b184596d37cffb4dd763fd3b92b754ce7" async="async"></script>
@endif
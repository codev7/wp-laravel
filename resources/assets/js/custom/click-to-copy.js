ZeroClipboard.config( { swfPath: "/js/ZeroClipboard.swf" } );
var client = new ZeroClipboard( document.getElementById("copy-button") );

client.on( "aftercopy", function( event ) {


    alert('You have copied ' + event.data["text/plain"] + ' to your clipboard.  Now go send us an email.  Remember: Ctrl+V to paste the email address.');

});
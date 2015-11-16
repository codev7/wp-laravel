/*
 * Chatlio event listener that checks if any agents are online.
 * 
 * Changes the color of chat icon in the footer.
 */
document.addEventListener('chatlio.ready', function (e) {

    var chatStatus = document.getElementById('chat-status');

    if (_chatlio.isOnline()) {
        chatStatus.className = 'state online';

    }
    else {
        chatStatus.className = 'state offline';

    }

}, false);

window.CMV = {

    toggleChat: function () {

        if (CObj.prod) {
            _chatlio.show({expanded: true});
            return false;

        }
        else {
            alert('this only works in production environment.');
        }
    },

    trackEvent: function (category, action, valueInDollars) {


        if (CObj.prod) {
            ga('send', {
                'hitType': 'event',
                'eventCategory': category,
                'eventAction': action,
                'eventValue': valueInDollars
            });


            _kmq.push(['record', action, {'Amount': valueInDollars, 'Category': category}]);
        }
        else {

            console.log('Event Tracked: ' + category + ' - ' + action);

        }

    }
};
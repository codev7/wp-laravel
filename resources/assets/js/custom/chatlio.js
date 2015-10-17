function toggleChat() {
    _chatlio.show({expanded: true}); return false;
}


document.addEventListener('chatlio.ready', function (e) {

    var chatStatus = document.getElementById('chat-status');

    if(_chatlio.isOnline())
    {
        chatStatus.className = 'state online';

    }
    else
    {
        chatStatus.className = 'state offline';

     }

}, false);

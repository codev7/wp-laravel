var CMV = {

    trackEvent: function(category, action, valueInDollars) {

        ga('send', {
            'hitType': 'event',
            'eventCategory': category,
            'eventAction': action,
            'eventValue': valueInDollars
        });


        _kmq.push(['record',  action , {'Amount' : valueInDollars, 'Category': category} ]);
    }
};
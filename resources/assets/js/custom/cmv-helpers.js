var CMV = {

    trackEvent: function(category, action, valueInDollars) {


        if(CObj.prod)
        {
            ga('send', {
                'hitType': 'event',
                'eventCategory': category,
                'eventAction': action,
                'eventValue': valueInDollars
            });


            _kmq.push(['record',  action , {'Amount' : valueInDollars, 'Category': category} ]);      
        }
        else
        {
            
            console.log('Event Tracked: ' + category + ' - ' + action);

        }
        
    }
};
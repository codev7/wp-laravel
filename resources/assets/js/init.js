var controllers = {
    'quote/form': require('./Vue/quote'),
    'portfolio/items': require('./Vue/portfolio'),
    'order/concierge': require('./Vue/concierge')
};

export default {
    controllers() {
        $('[data-controller]').each((el) => {
            let controller = controllers[$(el).attr('data-controller')];
            controller.$mount(el);
        });
    },
    bugsnag() {
        Bugsnag.apiKey = "15fde40c387140df4200a97e9dbf3f31";
        Bugsnag.releaseStage = CObj.environment;
    },
    pjax() {
        $(document).pjax('a[data-pjax]', '#pjax-container', {
            timeout: 3000
        });
    }
}
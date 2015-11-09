var controllers = {
    'job-application': require('./controllers/job-application'),
    'portfolio': require('./controllers/portfolio')
};
console.log(controllers);
var Bugsnag = require('bugsnag');

export default {
    controllers() {
        $('[data-controller]').each((i, el) => {
            var controller = controllers[$(el).attr('data-controller')];
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
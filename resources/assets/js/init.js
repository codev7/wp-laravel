var controllers = {
    'portfolio': require('./controllers/portfolio'),
    'project/briefs': require('./controllers/project/briefs'),
    'project/dashboard': require('./controllers/project/dashboard'),
    'project/files': require('./controllers/project/files'),
    'project/invoices': require('./controllers/project/invoices'),
    'project/todos': require('./controllers/project/todos'),
    'cmv-jobs': require('./controllers/cmv-jobs')
};
var inittedControllers = {};

var mountControllers = (selector) => {
    $(selector).each((i, el) => {
        var cName = $(el).attr('data-controller');
        if (controllers[cName] === undefined) console.warn(`Controller ${cName} is not found`);
        inittedControllers[cName] = new controllers[cName]().$mount(el);
    });
};
var unmountControllers = (selector) => {
    $(selector).each((i, el) => {
        var cName = $(el).attr('data-controller');
        if (inittedControllers[cName] !== undefined) {
            inittedControllers[cName].$destroy(true);
        }
    });
};

var Bugsnag = require('bugsnag');

export default {
    controllers() {
        mountControllers("[data-controller]");
    },
    bugsnag() {
        Bugsnag.apiKey = "15fde40c387140df4200a97e9dbf3f31";
        Bugsnag.releaseStage = CObj.environment;
    },
    pjax() {
        $(document).pjax('a[data-pjax]', '#pjax-container', {
            timeout: 3000
        });

        $(document).on('pjax:success', () => {
            mountControllers("#pjax-container [data-controller]");
        });
        $(document).on('pjax:beforeReplace'), () => {
            unmountControllers("#pjax-container [data-controller]");
        }
    }
}
var controllers = require('./vue/controllers');
var inittedControllers = {};
var initScripts = require('./misc/scripts');
var notify = require('./misc/notify');

var mountControllers = (selector) => {
    $(selector).each((i, el) => {
        var cName = $(el).attr('data-controller');
        el.id = _.randomStr();
        if (controllers[cName] === undefined) console.warn(`Controller ${cName} is not found`);
        inittedControllers[cName] = new controllers[cName]({el: `#${el.id}`});
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


export default {
    libraries() {
        window.placeholder = require('placeholder');
        window._ = require('lodash');
        require('./extensions/lodash');

        window.moment = require('moment');
        window.Bugsnag = require('bugsnag');

        Bugsnag.apiKey = "15fde40c387140df4200a97e9dbf3f31";
        Bugsnag.releaseStage = CObj.environment;
    },
    vue() {
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
        Vue.http.options.beforeSend = () => {
            // ..
        }
        Vue.http.options.onComplete = (req) => {
            // ..
            if (req.status == 422) {
                // show errors if server-side validation failed
                notify.validation(req.response);
            }
        }

        require('./vue/directives');
        require('./vue/filters');

        if ($('#spark-app').length > 0) {
            require('./vue/spark/components')
            new Vue(require('./vue/spark/spark'));
        }

        mountControllers("[data-controller]");
    },
    pjax() {
        $(document).pjax('a[data-pjax]', '#pjax-container', {
            timeout: 3000
        });

        $(document).on('pjax:clicked', () => {

            $('body').addClass('loading');

        });

        $(document).on('pjax:success', () => {
            mountControllers("#pjax-container [data-controller]");
            this.scripts();

            $('body').removeClass('loading');

            // make nav link active
            $("a[data-pjax]").each(function(i, el) {
                var $parent = $($(el).parent());

                if ($parent.is('li')) {
                    $(el).attr('href') == window.location.href ?
                        $parent.addClass('active') :
                        $parent.removeClass('active');
                }
            });
        });
        $(document).on('pjax:beforeReplace'), () => {
            unmountControllers("#pjax-container [data-controller]");
        }
    },
    scripts() {
        initScripts();
    }
}
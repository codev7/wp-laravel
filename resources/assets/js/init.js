var controllers = require('./vue/controllers');
var inittedControllers = {};

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

var Bugsnag = require('bugsnag');

export default {
    libraries() {
        require('./extensions/lodash');

        window.moment = require('moment');

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
                var data = JSON.parse(req.response);
                var template = _.template(`<ul class="list-unstyled">
                    <% _.forEach(data, function(errors) { %>
                        <% _.forEach(errors, function(error) {%>
                        <li><%- error %></li>
                        <% }); %>
                    <% }); %>
                </ul>`);

                swal({
                    title: "Errors occurred!",
                    text: template({data: data}),
                    html: true,
                    type: "warning",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ok",
                    closeOnConfirm: true
                });
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

        $(document).on('pjax:success', () => {
            mountControllers("#pjax-container [data-controller]");
        });
        $(document).on('pjax:beforeReplace'), () => {
            unmountControllers("#pjax-container [data-controller]");
        }
    }
}
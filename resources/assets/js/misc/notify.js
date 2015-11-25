export default {
    validation(messages) {
        var template = _.template(`<ul class="list-unstyled">
                    <% _.forEach(data, function(errors) { %>
                        <% _.forEach(errors, function(error) {%>
                        <li><%- error %></li>
                        <% }); %>
                    <% }); %>
                </ul>`);

        swal({
            title: "Errors occurred!",
            text: template({data: messages}),
            html: true,
            type: "warning",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
    },
    error(message) {
        swal({
            title: 'Error occurred!',
            type: "warning",
            text: message
        })
    },
    success(message) {
        swal({
            title: message,
            type: "success"
        });
    },
    confirm(title, text, onConfirm) {
        swal({
            title: title,
            text: text,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: true
        }, onConfirm);
    }
}
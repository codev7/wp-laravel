export default {
    validation(response) {
        var messages = JSON.parse(response);
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

    }
}
var DeleteAuthorModal = React.createClass({
    mixins: [AjaxMixin],
    deleteAuthor: function() {
        this.refs.modal.close();

        this.ajax(&#x27;DELETE&#x27;, &#x27;/blogs/&#x27;+this.props.blog_id+&#x27;/authors/&#x27;+this.props.author.id, {})
            .success(function() {
                this.props.onStateUpdate();
                alertify.success(&#x27;Author has beed deleted.&#x27;)
            }.bind(this));
    },
    render: function() {
        var author = this.props.author;

        return (
            &#x3C;Modal title=&#x22;Delete Author&#x22; ref=&#x27;modal&#x27;&#x3E;
                &#x3C;p&#x3E;After deletion all blogs and articles associated with the author will have no author.&#x3C;/p&#x3E;
                &#x3C;p&#x3E;{&#x27;Do you want to delete author &#x27; + author.first_name + &#x27; &#x27; + author.last_name + &#x27;?&#x27;}&#x3C;/p&#x3E;
                &#x3C;button className=&#x22;btn btn-danger&#x22; onClick={this.deleteAuthor}&#x3E;Confirm&#x3C;/button&#x3E;
            &#x3C;/Modal&#x3E;
        )
    }
});
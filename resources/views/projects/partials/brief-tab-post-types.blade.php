<div class="row">
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked">
            <li data-toggle="tab" class="active"><a href="#">Testimonials</a></li>
            <li data-toggle="tab"><a href="#">Case Studies</a></li>
        </ul>

        <div class="text-center m-t">
            <a href="#" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add Post Type</a>
        </div>
    </div><!--col-->

    <div class="col-sm-9">

        <small class="pull-right"><a href="#" class="text-danger"><i class="fa fa-trash"></i> Delete Post Type</a></small>

        <div class="form-group">
            <label>Post Type Name</label>
            <input type="text" class="form-control" placeholder="the name of the post type" />
        </div>
        <div class="form-group">
            <label>Quick Post Type Summary</label>
            <textarea class="form-control" rows="2" cols="4" placeholder="A description of the post type."></textarea>

        </div>

        <div class="form-group">
            <label>Has Single Post Page? <i class="fa fa-question-circle tooltipper" data-title="Will each post in the database have a single page on the site?"></i></label>

            <select class="custom-select form-control">
                <option>Yes</option>
                <option>No</option>
            </select>
        </div>

        <div class="form-group">
            <label>View for single post page <i class="fa fa-question-circle tooltipper" data-title="Which HTML view should the post type single post page use?"></i></label>

            <select class="custom-select form-control">
                <option>name of page.html</option>
                <option>name of page.html</option>
            </select>
        </div>

        <div class="form-group">
            <label>Include in site search results? <i class="fa fa-question-circle tooltipper" data-title="Should this post type appear in the sitewide search results?"></i></label>

            <select class="custom-select form-control">
                <option>Yes</option>
                <option>No</option>
            </select>
        </div>

        <div class="form-group">
            <label>Has an archives page? <i class="fa fa-question-circle tooltipper" data-title="Does this post type have an archive page that displays all of the post types with pagination?"></i></label>

            <select class="custom-select form-control">
                <option>Yes</option>
                <option>No</option>
            </select>
        </div>

        <div class="form-group">
            <label>View for archive page <i class="fa fa-question-circle tooltipper" data-title="Which HTML view should the post type archive page use?"></i></label>

            <select class="custom-select form-control">
                <option>name of page.html</option>
                <option>name of page.html</option>
            </select>
        </div>

        <div class="form-group">
            <label>Select Default Meta Data <i class="fa fa-question-circle tooltipper" data-title="Which default meta data should this post have?"></i></label>

            <select multiple class="form-control">
                <option>wp_title</option>
                <option>author</option>
                <option>content_wysiwyg</option>
                <option>excerpt</option>
                <option>menu_order</option>
                <option>thumbnail</option>
            </select>
        </div>

        <div class="clearfix"></div>
        <div class="form-group">
            <label>Custom Meta Data</label>

            <table class="table table-bordered table-middle">
                <thead>
                <tr>
                    <th style="width: 45%">Name</th>
                    <th style="width: 45%">Field Type</th>
                    <th style="width: 10%">&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>

                        <input class="form-control m-a-0" type="text" />
                    </td>
                    <td>
                        <select class="form-control custom-select m-a-0">
                            <option>Select a field type</option>
                            <option>text</option>
                            <option>textarea</option>
                            <option>file</option>
                            <option>image</option>
                            <option>repeater</option>
                        </select>
                    </td>

                    <td>
                        <a href="#" class="btn btn-danger-outline"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>

            <a href="#" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Add Item</a>
        </div>
    </div>
</div>

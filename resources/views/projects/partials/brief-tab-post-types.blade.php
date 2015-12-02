<div class="row">
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked" role="tablist">
            <li role="presentation"
                v-for="(postTypeIndex, postType) in brief.post_types">
                <a data-toggle="tab"
                   role="tab"
                   href="#@{{ 'post-type-tab-' + postTypeIndex }}"
                   aria-controls="@{{ 'post-type-tab-' + postTypeIndex }}">@{{ postType.name }}</a>
            </li>
        </ul>

        <div class="text-center m-t">
            <a href="#" class="btn btn-xs btn-success"
               v-on:click.prevent="addListItem('brief.post_types')">
                <i class="fa fa-plus"></i> Add Post Type
            </a>
        </div>
    </div><!--col-->

    <div class="tab-content">
        <div class="col-sm-9 tab-pane" role="tabpanel" id="post-type-tab-@{{ postTypeIndex }}"
             v-for="(postTypeIndex, postType) in brief.post_types">

            <small class="pull-right">
                <a href="#" class="text-danger"
                   v-on:click.prevent="removeListItem('brief.post_types', postTypeIndex)">
                    <i class="fa fa-trash"></i> Delete Post Type
                </a>
            </small>

            <div class="form-group">
                <label>Post Type Name</label>
                <input type="text" class="form-control" placeholder="the name of the post type"
                       v-model="postType.name" />
            </div>

            <div class="form-group">
                <label>Quick Post Type Summary</label>
                <textarea class="form-control" rows="2" cols="4" placeholder="A description of the post type."
                        v-model="postType.summary"></textarea>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" v-model="postType.has_single_post_page" /> Has Single Post Page? <i class="fa fa-question-circle tooltipper" data-title="Will each post in the database have a single page on the site?"></i>
                </label>
            </div>

            <div class="form-group">
                <label>View for single post page <i class="fa fa-question-circle tooltipper" data-title="Which HTML view should the post type single post page use?"></i></label>

                <select class="custom-select form-control">
                    <option>name of page.html</option>
                    <option>name of page.html</option>
                </select>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" v-model="postType.include_in_search" /> Include in site search results? <i class="fa fa-question-circle tooltipper" data-title="Should this post type appear in the sitewide search results?"></i>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" v-model="postType.has_archive"/> Has an archives page? <i class="fa fa-question-circle tooltipper" data-title="Does this post type have an archive page that displays all of the post types with pagination?"></i>
                </label>
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

                <select multiple class="form-control" v-model="postType.meta_data">
                    <option value="@{{ option.value }}" v-for="option in templates.blanks.select.meta_data">
                        @{{ option.text }}
                    </option>
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
                    <tr v-for="(metaFieldIndex, metaField) in postType.custom_meta_fields">
                        <td>
                            <input class="form-control m-a-0" type="text" v-model="metaField.name" />
                            <label>
                                <input type="checkbox" v-model="metaField.required"/> Required
                            </label>
                        </td>
                        <td>
                            <select class="form-control custom-select m-a-0" v-model="metaField.type">
                                <option value="@{{ option.value }}" v-for="option in templates.blanks.select.meta_field_types">
                                    @{{ option.text }}
                                </option>
                            </select>
                        </td>

                        <td>
                            <a href="#" class="btn btn-danger-outline"
                               v-on:click.prevent="removeListItem('brief.post_types['+postTypeIndex+'].custom_meta_fields', metaFieldIndex)">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <a href="#" class="btn btn-xs btn-success pull-right"
                   v-on:click.prevent="addListItem('brief.post_types['+postTypeIndex+'].custom_meta_fields')">
                    <i class="fa fa-plus"></i> Add Custom Meta Field
                </a>
            </div>

            <div class="clearfix"></div>

            <div class="form-group">
                <label>Taxonomies</label>

                <table class="table table-bordered table-middle">
                    <thead>
                    <tr>
                        <th style="width: 90%">Name</th>
                        <th style="width: 10%">&nbsp;</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="(taxonomyIndex, taxonomy) in postType.taxonomies">
                        <td>
                            <input class="form-control m-a-0" type="text" v-model="taxonomy.name" />
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger-outline"
                               v-on:click.prevent="removeListItem('brief.post_types['+postTypeIndex+'].taxonomies', taxonomyIndex)">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <a href="#" class="btn btn-xs btn-success pull-right"
                   v-on:click.prevent="addListItem('brief.post_types['+postTypeIndex+'].taxonomies')">
                    <i class="fa fa-plus"></i> Add Taxonomy
                </a>
            </div>

        </div>
    </div>
</div>
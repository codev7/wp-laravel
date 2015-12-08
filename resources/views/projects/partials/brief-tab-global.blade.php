<div class="form-group">
    <label>Global Notes</label>

    <textarea class="form-control hide" rows="10" cols="4"
              v-model="brief.global.notes" v-trix>
    </textarea>
</div>

<div v-if="brief.global && brief.global.menu_items">
    <div class="row">
        <div class="col-sm-3">
            <ul class="nav nav-pills nav-stacked" role="tablist">
                <li role="presentation"
                    v-for="(menuItemIndex, menuItem) in brief.global.menu_items">
                    <a data-toggle="tab"
                       role="tab"
                       href="#@{{ 'menu-item-tab-' + menuItemIndex }}"
                       aria-controls="@{{ 'menu-item-tab-' + menuItemIndex }}">@{{ menuItem.header }}</a>
                </li>
            </ul>

            <div class="text-center m-t">
                <a href="#" class="btn btn-xs btn-success"
                   v-on:click.prevent="addListItem('brief.global.menu_items')">
                    <i class="fa fa-plus"></i> Add Menu Item
                </a>
            </div>
        </div><!--col-->

        <div class="tab-content">
            <div class="col-sm-9 tab-pane" role="tabpanel" id="menu-item-tab-@{{ menuItemIndex }}"
                 v-for="(menuItemIndex, menuItem) in brief.global.menu_items">


                <small class="pull-right">
                    <a href="#" class="text-danger"
                       v-on:click.prevent="removeListItem('brief.global.menu_items', menuItemIndex)">
                        <i class="fa fa-trash"></i> Delete Menu Item
                    </a>
                </small>

                <div class="form-group">
                    <label>Menu Item Header</label>
                    <input type="text" class="form-control" placeholder="menu item header"
                           v-model="menuItem.header"/>
                </div>

                <div class="form-group">
                    <label>Menu Item Content</label>
                    <textarea class="form-control" rows="2" cols="4" placeholder=""
                              v-model="menuItem.content" v-trix>
                    </textarea>
                </div>

                <brief-checklist :path="'brief.global.menu_items['+menuItemIndex+'].checklist'"
                                 :checklist.sync="menuItem.checklist">
                </brief-checklist>

            </div>
        </div>
    </div>
</div>

<div v-if="brief.global && brief.global.theme_menus">
    <div class="form-group">
        <label>Theme Menus</label>

        <table class="table table-bordered table-middle" v-if="brief.global.theme_menus.length">
            <thead>
            <tr>
                <th style="width: 45%">Name</th>
                <th style="width: 45%">Description</th>
                <th style="width: 10%">&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(themeMenuIndex, themeMenu) in brief.global.theme_menus">
                <td>
                    <input class="form-control m-a-0" type="text" v-model="themeMenu.name" />
                </td>
                <td>
                    <textarea class="form-control m-a-0" rows="4" cols="2"
                              v-model="themeMenu.description">
                    </textarea>
                </td>
                <td>
                    <a href="#" class="btn btn-danger-outline"
                       v-on:click.prevent="removeListItem('brief.global.theme_menus', themeMenuIndex)">
                        <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>

        <a href="#" class="btn btn-xs btn-success pull-right"
           v-on:click.prevent="addListItem('brief.global.theme_menus')">
            <i class="fa fa-plus"></i> Add Theme Menu
        </a>

        <div class="clearfix"></div>
    </div>

</div>

<brief-checklist v-if="brief.global && brief.global.checklist"
                 :path="'brief.global.checklist'"
                 :checklist.sync="brief.global.checklist">
</brief-checklist>
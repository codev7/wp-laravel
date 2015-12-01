<div class="row">
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked">
            <li v-for="section in brief.sections" data-toggle="tab" class="active">
                <a href="#">@{{ section.name }}</a>
            </li>
        </ul>

        <div class="text-center m-t">
            <a href="#" class="btn btn-xs btn-success"
               v-on:click.prevent="addListItem('brief.sections')">
                <i class="fa fa-plus"></i> Add Section
            </a>
        </div>
    </div><!--col-->

    <div class="col-sm-9" v-for="(sectionIndex, section) in brief.sections">

        <small class="pull-right">
            <a href="#" class="text-danger"
               v-on:click.prevent="removeListItem('brief.sections', sectionIndex)">
                <i class="fa fa-trash"></i> Delete Section
            </a>
        </small>

        <div class="form-group">
            <label>Section Name</label>
            <input type="text" class="form-control" placeholder="the unique name of the section"
                   v-model="section.name"/>
        </div>

        <div class="form-group">
            <label>Quick Section Summary</label>
                    <textarea class="form-control" rows="2" cols="4" placeholder="A description of the section."
                              v-model="section.summary"></textarea>
        </div>

        <div class="clearfix"></div>

        <div class="text-center m-t">
            <a href="#" class="btn btn-xs btn-success"
               v-on:click.prevent="addListItem('brief.sections['+sectionIndex+'].sub_sections')">
                <i class="fa fa-plus"></i> Add Sub Section
            </a>
        </div>

        <div v-for="(subsectionIndex, subsection) in section.sub_sections">

            <hr/>

            <small class="pull-right">
                <a href="#" class="text-danger"
                   v-on:click.prevent="removeListItem('brief.sections['+sectionIndex+'].sub_sections', subsectionIndex)">
                    <i class="fa fa-trash"></i> Delete Section
                </a>
            </small>

            <div class="form-group">
                <label>Sub Section Header</label>
                <input type="text" class="form-control" placeholder="sub section menu header"
                       v-model="subsection.header"/>
            </div>

            <div class="form-group">
                <label>Subsection Content</label>
                        <textarea class="form-control" rows="2" cols="4" placeholder=""
                                  v-model="subsection.content"
                                  v-trix>
                        </textarea>
            </div>

            <brief-checklist v-if="subsection.checklist"
                             :path="'brief.sections['+sectionIndex+'].sub_sections['+subsectionIndex+'].checklist'"
                             :checklist.sync="subsection.checklist">
            </brief-checklist>
        </div>
    </div>
</div>

<div class="text-center m-t" v-if="brief.brief_boxes.length < 3">
    <a href="#" class="btn btn-xs btn-success"
       v-on:click.prevent="addListItem('brief.brief_boxes')">
        <i class="fa fa-plus"></i> Add Brief Box
    </a>

    <small>(Maxium: 3 Boxes)</small>
</div>

<div v-for="(boxIndex, box) in brief.brief_boxes">
    <small class="pull-right">
        <a href="#" class="text-danger"
           v-on:click.prevent="removeListItem('brief.brief_boxes', boxIndex)">
            <i class="fa fa-trash"></i> Delete Section
        </a>
    </small>

    <div class="form-group">
        <label>Brief Box Title</label>
        <input type="text" class="form-control" placeholder="the unique title of the brief box"
               v-model="box.title"/>
    </div>

    <div class="form-group">
        <label>Quick Section Summary</label>
                    <textarea class="form-control" rows="2" cols="4" placeholder="A description of the section."
                              v-model="box.description">
                    </textarea>
    </div>

    <div class="form-group">
        <label>Brief Box Tooltip</label>
        <input type="text" class="form-control" placeholder="brief box tooltip content"
               v-model="box.tooltip"/>
    </div>
</div>
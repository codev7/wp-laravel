<div class="form-group">
    <label>Global Notes</label>
            <textarea class="form-control hide" rows="10" cols="4"
                      v-model="brief.global.notes"
                      v-trix></textarea>
</div>

<brief-checklist v-if="brief.global && brief.global.checklist"
                 :path="'brief.global.checklist'"
                 :checklist.sync="brief.global.checklist">
</brief-checklist>

{{--menu_items coming soon--}}

{{--theme_menus coming soon--}}

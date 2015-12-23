<div class="modal fade in" id="new-activity">
    <div class="modal-dialog modal-sm">
        <form action="{{ route('prospector.create-activity', ['company_id' => $company->id]) }}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Log New Activity</h4>
                </div>
                <div class="modal-body">
    
                    <div class="hr-divider m-b">
                      <h3 class="hr-divider-content hr-divider-heading">{{ $company->name }}</h3>
                    </div>
                    @if(isset($contact))
                    <div class="form-group">
                        <label>Contact</label>
                        <input type="hidden" name="contact_id" value="{{ $contact->id }}" />
                        <input type="text" class="form-control" disabled="disabled" value="{{ $contact->email }}">
                    </div>
                    @else
                    <div class="form-group">
                        <label>Contact</label>
                        <select name="contact_id" class="form-control">
                            <option value="">No contact associated</option>

                            @foreach($company->contacts as $contact)
                            <option value="{{ $contact->id }}">{{ $contact->email }}</option>
                            @endforeach

                        </select>
                    </div>
                    @endif

                    <div class="form-group">
                        <label>Content</label>

                        <textarea class="form-control" rows="10" cols="" name="content"></textarea>
                    </div><!--form-group-->
            </div>
            <div class="modal-actions">
                <button type="button" tabindex="-1" class="btn-link modal-action" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="$('#new-activity form').submit();" class="btn-link modal-action btn-success">
                    <strong>Save</strong>
                </button>
            </div>
        </div>
    </form>
</div>
</div>
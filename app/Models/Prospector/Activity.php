<?php

namespace CMV\Models\Prospector;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
* Each sales rep in the system must track their activity.
* Emails are logged as activity, as well as phone calls, and reps
* can upload other activity on the contact or company page.
* Eventually, we will setup a cc@codemyviews.com email address
* that reps can use to automatically log email activity.
* Currently, we are syncing this with PipelineDeals API which
* already has the cc@pipelinedeals.com functionality built out.
*
* Currently, sales reps are using cc@pipelinedeals.com to
* track activity, and that data is imported into this model.
*/
class Activity extends Model
{
    use SoftDeletes;
    protected $columns = [
        'id',
        'company_id',
        'contact_id',
        'sales_rep_id',
        'content',
        'pipeline_deals_id', //used so we dont duplicate pipelinedeals api imports
        'created_at',
        'updated_at',
        'deleted_at'
    ]; 

    protected $fillable = ['content'];

    public function company()
    {

        return $this->belongsTo('Company');

    }


    public function contact()
    {

        return $this->belongsTo('Contact');

    }


    public function salesRep()
    {

        return $this->belongsTo('CMV\User','sales_rep_id');

    }
}

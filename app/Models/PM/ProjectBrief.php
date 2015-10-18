<?php

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;

class ProjectBrief extends Model
{
    protected $columns = [
        'id',
        'text', //will most likely be some sort of json until I figure out actual data structure for the ProjectBriefs
        'project_type_id',
        'created_by_id',
        'approved_by_customer_id',
        'approved_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function project()
    {
        return $this->belongsTo('Project');
   }

   public function createdByUser()
   {
        return $this->belongsTo('CMV\User','created_by_id');
   }

   public function approvedByUser()
   {
        return $this->belongsTo('CMV\User','approved_by_customer_id');
   }
}

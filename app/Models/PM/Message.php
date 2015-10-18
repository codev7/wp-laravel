<?php

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $columns = [
        'id',
        'reference_id',
        'reference_type', //concierge_site || project
        'user_id',
        'parent_message_id', //null if not a child message
        'comment', //text field w/ markdown allowed
        'todo_reference_id', //null if no bug is referenced
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function project()
    {
        return $this->belongsTo('Project','reference_id');
    }

    public function conciergeSite()
    {
        return $this->belongsTo('ConciergeSite','reference_id');
    }

    public function user()
    {
        return $this->belongsTo('CMV\User');
    }

    public function parent()
    {
        return $this->belongsTo('Message','parent_message_id');
    }

    public function toDo()
    {
        return $this->belongsTo('ToDo','todo_reference_id');
    }
}

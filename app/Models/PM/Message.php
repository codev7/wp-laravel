<?php

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
* This model holds data that pertains to the messages that happen
* in both Projects and ConciergeSite.  In both of those objects,
* there are conversations that happen between all of the users that
* interact with the site/project.
* 
* Message's can have replies which are also stored in this
* table/model via the parent_message_id attribute.
*
* A to-do item can also be referenced by a message via the
* todo_reference_id attribute.
*/
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

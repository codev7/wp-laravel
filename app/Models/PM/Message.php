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
        'thread_id',
        'user_id',
        'content', //text field w/ markdown allowed
//        'todo_reference_id', //null if no bug is referenced
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('CMV\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo('CMV\Models\PM\Thread');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeRandom($query)
    {
        return $query->orderBy(\DB::raw('RAND()'));
    }
}

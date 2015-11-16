<?php
namespace CMV\Events;

use CMV\User;

class UserEvents extends Event
{

    /**
     * @Hears("user.registered")
     */
    public function registered(User $user)
    {
        // .. send email
    }

}

<?php
namespace CMV\Events;

use CMV\Models\PM\Project;

class ProjectEvents extends Event
{

    /**
     * Is fired when new developer is assigned to the project
     * @Hears("project.developer-assigned")
     * @param Project $project
     */
    public static function projectUpdated(Project $project)
    {
        // .. send email
    }

}

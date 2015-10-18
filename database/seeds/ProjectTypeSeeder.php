<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        /* Set Project Types */
        foreach(CMV\Models\PM\ProjectType::$defaults as $type)
        {   
            factory(CMV\Models\PM\ProjectType::class)->create(['name' => $type]);
        }

        Model::reguard();
    }
}
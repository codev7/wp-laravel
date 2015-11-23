<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProjectManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        

        /* Developers */
        factory(CMV\User::class, 'developer',8)->create();

        /* Project Manager */
        factory(CMV\User::class, 'project_manager',5)->create();

        /* Teams */
        factory(CMV\Team::class,50)->create()->each(function($team) {

            $owner = factory(CMV\User::class)->create();

            $team->owner()->associate($owner);
            $team->save();

            $team->users()->attach($owner->id, ['role' => 'owner']);

            //save team members
            factory(CMV\User::class,4)->create()->each(function($user) use($team) {
                $team->users()->attach($user->id, ['role' => 'member']);
            });
        });

        Model::reguard();
    }
}

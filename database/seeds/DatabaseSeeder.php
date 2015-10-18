<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(CMV\Models\AwwwardsScraper\AwwwCategory::class, 10)->create();

        factory(CMV\Models\AwwwardsScraper\Awwward::class, 50)->create()->each(function($u) {


            $category = CMV\Models\AwwwardsScraper\AwwwCategory::all();

            $u->categories()->save($category->random(1));

        });

        /* Customers */
        factory(CMV\User::class,50)->create();

        /* Developers */
        factory(CMV\User::class, 'developer',8)->create();

        /* Project Manager */
        factory(CMV\User::class, 'project_manager',5)->create();

        /* Sales Reps */
        factory(CMV\User::class, 'sales_rep',3)->create();

        factory(CMV\Team::class,50)->create()->each(function($team) {


            $customers = CMV\User::where('is_admin',false)
                                ->where('is_mastermind',false)
                                ->where('is_developer',false)
                                ->where('is_sales_rep',false)
                                ->get();

            //save owner
            $team->owner()->save($customers->random());

            $numberOfTeamMates = 3;
            $count = 0;

            while($count <= $numberOfTeamMates)
            {
                $team->users()->attach($customers->random()->id);
            }

            
        });

        Model::reguard();
    }
}

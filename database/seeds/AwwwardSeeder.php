<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AwwwardSeeder extends Seeder
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
    

        Model::reguard();
    }
}

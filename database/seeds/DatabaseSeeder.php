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
                
        $this->call(ProjectManagementSeeder::class);
        $this->call(ProjectTypeSeeder::class);
        $this->call(ConciergeSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(ProspectorSeeder::class);
        $this->call(AwwwardSeeder::class);

        Model::reguard();
    }
}

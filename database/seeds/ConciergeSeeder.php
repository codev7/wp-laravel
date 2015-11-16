<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ConciergeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /* Load Sample Concierge Sites */
        factory(CMV\Models\PM\ConciergeSite::class,35)->create()->each(function($site){

            $site->team()->associate( CMV\Team::random()->take(1)->first() );
            $site->developer()->associate( CMV\User::where('is_developer',true)->random()->take(1)->first() );
            $site->projectManager()->associate( CMV\User::where('is_admin',true)->random()->take(1)->first() );

            $site->save();

            $site->toDos()->saveMany( factory( CMV\Models\PM\ToDo::class, rand(2,10))->make(['reference_type' => 'concierge'])->each(function($toDo) use($site){

                $toDo->createdBy()->associate( $site->team->users()->random()->take(1)->first() );
                $toDo->save();
            }));

            for($i=0; $i<=rand(0,3); $i++) {
                $thread = factory( CMV\Models\PM\Thread::class)->make(['reference_type' => 'concierge_site']);
                $thread->reference()->associate($site);
                $thread->save();

                for($j=0; $j<rand(1,4); $j++) {
                    /** @var \CMV\Models\PM\Message $message */
                    $message = factory( CMV\Models\PM\Message::class)->make();
                    $user = $site->team->users()->random()->take(1)->first();
                    $message->user()->associate($user);
                    $message->save();

                    $thread->messages()->save($message);
                }
            }
        });

        Model::reguard();
    }
}
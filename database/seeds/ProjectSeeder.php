<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProjectSeeder extends Seeder
{

     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /* Load Sample Projects */
        factory(CMV\Models\PM\Project::class,35)->create()->each(function($project){
            $project->project_type = rand(0, 1) ? 'project' : 'concierge_site';

            $project->team()->associate( CMV\Team::random()->take(1)->first() );
            $project->developer()->associate( CMV\User::where('is_developer',true)->random()->take(1)->first() );
            $project->projectManager()->associate( CMV\User::where('is_admin',true)->random()->take(1)->first() );
            $project->type()->associate( CMV\Models\PM\ProjectType::random()->take(1)->first() );

            $project->save();

            /* Create project briefs */
            $project->briefs()->saveMany( factory( CMV\Models\PM\ProjectBrief::class, 2)->make()->each(function($brief) use($project){

                if($brief->approved_at)
                {
                    $brief->approvedByUser()->associate( $project->team->users()->random()->take(1)->first() );   
                }

                $brief->createdByUser()->associate( $project->projectManager );
                $brief->save();
            
            }));

            $project->toDos()->saveMany( factory( CMV\Models\PM\ToDo::class, rand(2,10))->make(['reference_type' => 'project'])->each(function($toDo) use($project){

                $toDo->createdBy()->associate( $project->team->users()->random()->take(1)->first() );
                $toDo->save();
            }));

            for($i=0; $i<=rand(0,3); $i++) {
                $thread = factory( CMV\Models\PM\Thread::class)->make(['reference_type' => 'project']);
                $thread->reference()->associate($project);
                $thread->save();

                for($j=0; $j<rand(1,4); $j++) {
                    /** @var \CMV\Models\PM\Message $message */
                    $message = factory( CMV\Models\PM\Message::class)->make();
                    $user = $project->team->users()->random()->take(1)->first();
                    $message->user()->associate($user);
                    $message->save();

                    $thread->messages()->save($message);
                }
            }

            $invoice = $project->invoices()->save( factory( CMV\Models\PM\Invoice::class)->make(['reference_type' => 'project']) );
            
            $invoice->lineItems()->saveMany( factory( CMV\Models\PM\LineItem::class, rand(4,8))->make() );


        });
        
         Model::reguard();
    }

}

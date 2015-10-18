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
      
            $project->messages()->saveMany( factory( CMV\Models\PM\Message::class, rand(2,20))->make(['reference_type' => 'project'])->each(function($message) use($project){

                $message->user()->associate( $project->team->users()->random()->take(1)->first() );
                $message->save();
            }));
            


            $invoice = $project->invoices()->save( factory( CMV\Models\PM\Invoice::class)->make(['reference_type' => 'project']) );
            
            $invoice->lineItems()->saveMany( factory( CMV\Models\PM\LineItem::class, rand(4,8))->make() );


        });
        
         Model::reguard();
    }

}

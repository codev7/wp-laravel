<?php

namespace CMV\Console\Commands;

use Illuminate\Console\Command;

use CMV\Misc\PipelineDeals;
use CMV\Contact;
use CMV\Company;
use CMV\User;

class ImportPersonNotesFromPipelineCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pipeline:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from pipeline deals.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();



    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {      
        
        $this->importReps();  
        $this->importPeople();
        $this->importActivity();



    }


    protected function importActivity()
    {

        $pipeline = new PipelineDeals();


        $contacts = Contact::whereNotNull('pipeline_deals_id')->get();

        foreach($contacts as $contact)
        {   
            
            $notes = $pipeline->doRequest('notes',['person_id' => $contact->pipeline_deals_id],1);

            if(isset($notes['entries']))
            {
                $contact->activities()->delete();
                foreach($notes['entries'] as $entry)
                {
                    $activity = new \CMV\Activity([
                        'content' => $entry['content']
                    ]);

                    $contact->activities()->save( $activity );

                    $activity->created_at = strtotime($entry['created_at']);
                    $activity->updated_at = strtotime($entry['updated_at']);

                    $rep = User::where('pipeline_user_id', $entry['user']['id'])->first();

                    $activity->sales_rep_id = $rep ? $rep->id : null;
                    $activity->company_id = $contact->company_id;
                    $activity->save();
                }  

            }
        }

        


    }

    protected function importReps()
    {
        $reps = [
            ['name' => 'Joe Swint', 'email' => 'joe@codemyviews.com','pipeline_user_id' => '174811'],
            ['name' => 'Connor Hood', 'email' => 'connor@codemyviews.com','pipeline_user_id' => '152653'],
            ['name' => 'Nate McGuire', 'email' => 'nate@codemyviews.com','pipeline_user_id' => '165982'],
        ];

        foreach($reps as $rep)
        {   

            $salesRep = User::firstOrCreate(['email' => $rep['email']]);

            foreach($rep as $key => $value)
            {

                $salesRep->{$key} = $value;

            }

            $salesRep->save();
        }
    }

    protected function importPeople()
    {


        $pipeline = new PipelineDeals();

        $people = $pipeline->doRequest('people',[],1);

        $totalPages = $people['pagination']['pages'];
        $currentPage = 1;

        while($currentPage <= $totalPages)
        {

            $this->info('Current Page: ' . $currentPage);
            $this->processPeople( $pipeline->doRequest('people',[],$currentPage) );

            $currentPage++;
        }
    }

    protected function processPeople( $people )
    {   
        foreach($people['entries'] as $person)
        {

            $contact = Contact::where('email', $person['email'])->first();

            if(!$contact)
            {
                
                $contact = $this->createNewContact( $person );

            }

            if($contact) {

                $contact->company->assignToSalesRepyByPipelineUserId( $person['user']['id'] );

                $contact->pipeline_deals_id = $person['id'];
                $contact->save();   
            }
            
        }
    }

    protected function createNewContact( $person )
    {      
        if(empty($person['company_name']))
        {
            $this->error('Could not add ' . $person['email']. '.  No company name.');
            return false;
        }
        $this->info('Adding a new contact: ' . $person['email'] .'  at ' . $person['company_name'] .'.');
        $company = Company::firstOrCreate(['name' => $person['company_name']]);

        return $company->contacts()->firstOrCreate(['email' => $person['email']]);


    }
}

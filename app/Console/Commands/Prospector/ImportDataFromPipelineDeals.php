<?php

namespace CMV\Console\Commands\Prospector;

use Illuminate\Console\Command;

use CMV\Misc\PipelineDeals;
use CMV\Models\Prospector\Contact;
use CMV\Models\Prospector\Company;
use CMV\User;

class ImportDataFromPipelineDeals extends Command
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
     * @var PipelineDeals
     */
    protected $pipeline;


    public function __construct()
    {
        parent::__construct();
        $this->pipeline = new PipelineDeals();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->importReps();
        $this->importCompanies();
        $this->importContacts();
        $this->importActivities();
    }

    protected function importCompanies()
    {
        $currentPage = 1;
        do {
            $this->info('Current Page: ' . $currentPage);
            $companies = $this->pipeline->doRequest('companies', [], $currentPage);
            foreach($companies['entries'] as $entry)
            {
                $company = Company::firstOrCreate(['name' => $entry['name']]);
                $company->save();
            }

            $currentPage++;
            $totalPages = $companies['pagination']['pages'];
        } while ($currentPage <= $totalPages);
    }
    /**
     * Import Contact data from Pipeline Deals
     *
     * @return void
     */
    protected function importContacts()
    {
        $currentPage = 1;
        do {
            $this->info('Current Page: ' . $currentPage);
            $people = $this->pipeline->doRequest('people', [], $currentPage);
            foreach($people['entries'] as $person)
            {
                $this->saveContact($person);
            }

            $currentPage++;
            $totalPages = $people['pagination']['pages'];
        } while ($currentPage <= $totalPages);
    }

    /**
     * Save Contact info from Pipeline Deals data
     *
     * @param array $person contact info from Pipeline Deals
     * @return void
     */
    protected function saveContact(array $person)
    {
        $contact = Contact::where('email', $person['email'])->first();
        if(!$contact)
        {
            $contact = $this->createNewContact($person);
        }

        if($contact) {
            $contact->pipeline_deals_id = $person['id'];
            $contact->save();
        }
    }

    /**
     * Tries to create new Contact from Pipeline Deals info
     *
     * @param $person
     * @return bool|Contact created Contact or false on error
     */
    protected function createNewContact($person)
    {
        if(empty($person['company_name']))
        {
            $this->error('Could not add ' . $person['email']. '.  No company name.');
            return false;
        }

        $this->info('Adding a new contact: ' . $person['email'] .' at ' . $person['company_name'] .'.');
        $company = Company::firstOrCreate(['name' => $person['company_name']]);
        return $company->contacts()->firstOrCreate(['email' => $person['email']]);
    }

    /**
     * Import Activity logs from Pipeline Deals
     * Logs are only imported for Contacts from Pipeline Deals
     *
     * @return void
     */
    protected function importActivities()
    {
        $currentPage = 1;
        do {
            $this->info('Current Page: ' . $currentPage);
            $notes = $this->pipeline->doRequest('notes', [], $currentPage);

            foreach($notes['entries'] as $note)
            {
                $activity =  \CMV\Models\Prospector\Activity::firstOrCreate([
                    'pipeline_deals_id' => $note['id']
                ]);
                $activity->content = $note['content'];
                $activity->created_at = strtotime($note['created_at']);
                $activity->updated_at = strtotime($note['updated_at']);

                $rep = User::where('pipeline_user_id', $note['user']['id'])->first();
                if($rep) {
                    $activity->salesRep()->associate($rep);
                } else {
                    $this->error("no rep with pipeline_user_id #{$note['user']['id']} found");
                }

                $company = Company::where('name', $note['company']['name'])->first();
                if($company) {
                    $activity->company()->associate($company);
                } else {
                    $this->error("no company with name '{$note['company']['name']}' found");
                }

                $contact = Contact::where(['pipeline_deals_id' => $note['person_id']])->first();
                if($contact) {
                    $activity->contact()->associate($contact);
                } else {
                    $this->error("no contact with pipeline_deals_id #{$note['person_id']} found");
                }

                $activity->save();

                if($rep && $company) {
                    $company->salesRep()->associate($rep);
                    $company->save();
                }
            }

            $currentPage++;
            $totalPages = $notes['pagination']['pages'];
        } while ($currentPage <= $totalPages);
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
}

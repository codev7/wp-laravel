<?php

namespace CMV\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;

use CMV\Company;
use CMV\Contact;
use CMV\User;

class ImportProspectCSVCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:import {path_to_file?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all CSVs from the storage/csvs directory.';

    /**
     * The required column names in each of the CSVs.
     *
     * @var array
     */
    protected $requiredColumns;

    protected $contactMetaFields;

    protected $companyMetaFields;

    protected $globalDataArray;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->requiredColumns = ['company_name','email','first_name','last_name'];
    
        $this->companyMetaFields = ['website','company_formatted_address','company_address','company_city','company_state','company_postal_code','company_country','size','linkedin_company_url','locality','locality_city','locality_state','locality_state_code','locality_country','industry','leadsource','linkedin_company_industry','address','city','state','country','industry','twitter','facebook','google+','comments/extra'];
        $this->contactMetaFields = ['phone','email_status','linkedin_public_profile_url','email_type','linkedin_url','title','linkedin'];
        
        $this->globalDataArray = [];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   


        if( $this->argument('path_to_file') ) {   
            
            $this->processCsv( Reader::createFromPath( $this->argument('path_to_file') )  );
             
        } else {

            foreach (\File::allFiles(storage_path() . '/csvs') as $partial) {

                $this->info($partial->getPathName());

                $this->processCsv( Reader::createFromPath($partial->getPathName()) );
                

            }  

        }


        $this->processGlobalMetaData();
        
    }

    protected function processGlobalMetaData()
    {
        $this->info('Processing company meta data...');
        foreach($this->globalDataArray['companies'] as $company_name => $data)
        {

            $company = Company::where('name', $company_name)->first();

            \DB::table('company_metas')->where('company_id', $company->id)->delete();

            $meta = [];
            foreach($data as $key => $value)
            {

                if($value != '') $meta[] = new \CMV\CompanyMeta(['key' => $key, 'value' => $value]);

            }
            $company->meta()->saveMany($meta);
            

        }
        
        $this->info('Processing contact meta data...');
        foreach($this->globalDataArray['contacts'] as $email => $data)
        {

            $contact = Contact::where('email', $email)->first();
            \DB::table('contact_metas')->where('contact_id', $contact->id)->delete();

            $meta = [];
            foreach($data as $key => $value)
            {

                if($value != '') $meta[] = new \CMV\ContactMeta(['key' => $key, 'value' => $value]);

            }
            $contact->meta()->saveMany($meta);
            

        }
    }

    protected function processCsv( $csv )
    {
        $this->info('Verifying required columns exist...');


        $headers = $this->formatHeaderNames( $csv->fetchOne() );


        $fileValidated = true;

        foreach($this->requiredColumns as $required)
        {

            if(!in_array($required, $headers))
            {
                $fileValidated = false;
            }

        }


        if($fileValidated === false)
        {

            $this->error('This CSV does not have all of the required columns.');
            return false;
        }

        $this->info('All required fields are present.  Importing prospects...');

        foreach($csv->setOffset(1)->fetchAll() as $row) {
            
            $this->addDataToGlobal( $row,  $headers);
            $this->importProspect( $row,  $headers);


        }
    }

    protected function importProspect($data, $headers)
    {

        $values = [];
        
        foreach($data as $count => $value)
        {

            $values[ $headers[$count] ] = $value;

        }

        if($values['company_name'] == '')
        {   
            $this->error('We do not have a company name. Skipping...');
            return false;
        }
        $company = Company::firstOrCreate(['name' => $values['company_name']]);

        if($values['email'] == '')
        {
            $this->error('We do not have an email.  Skipping...');
            return false;
        }
        $contact = $company->contacts()->firstOrCreate(['email' => $values['email']]);

        if(isset($values['type']))
        {
            $company->type = $values['type'];
        }

        if(isset($values['first_name']))
        {

            $contact->first_name = $values['first_name'];

        }

        if(isset($values['last_name']))
        {

            $contact->last_name = $values['last_name'];

        }

        $contact->save();
        $company->save();
    }

    protected function addDataToGlobal($row, $headers)
    {

        $values = [];
        foreach($row as $count => $value)
        {

            $values[ $headers[$count] ] = $value;

        }

        if($values['company_name'] == '')
        {   
            return false;
        }

        /* Save Company Meta Data */
        foreach($this->companyMetaFields as $metaField)
        {

            if(isset( $values[ $metaField ] ))
            {

                $this->globalDataArray['companies'][ $values['company_name'] ][ $metaField ] = $values[ $metaField ];

            }

        }

        if($values['email'] == '')
        {   
            return false;
        }

        /* Save Company Meta Data */
        foreach($this->contactMetaFields as $metaField)
        {

            if(isset( $values[ $metaField ] ))
            {

                $this->globalDataArray['contacts'][ $values['email'] ][ $metaField ] = $values[ $metaField ];

            }

        }
      
        


    }


    protected function formatHeaderNames($headers)
    {

        $output = [];


        foreach($headers as $header)
        {
            $output[] = str_replace(' ','_',strtolower($header));
        }

        return $output;
    }
}

<?php

namespace CMV\Console\Commands;

use CMV\Models\Prospector\Company;
use CMV\Models\Prospector\Contact;
use Illuminate\Console\Command;
use League\Csv\Reader;

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
     * @see $this->headersAreValid
     * @var array
     */
    protected $requiredColumns = ['company_name','email','first_name','last_name'];

    /**
     * Column names which contains important meta for contacts
     *
     * @see $this->fetchContactMeta
     * @var array
     */
    protected $contactMetaFields = ['website','company_formatted_address','company_address','company_city','company_state','company_postal_code','company_country','size','linkedin_company_url','locality','locality_city','locality_state','locality_state_code','locality_country','industry','leadsource','linkedin_company_industry','address','city','state','country','industry','twitter','facebook','google+','comments/extra'];

    /**
     * Column names which contains important meta for companies
     *
     * @see $this->fetchCompanyMeta
     * @var array
     */
    protected $companyMetaFields = ['phone','email_status','linkedin_public_profile_url','email_type','linkedin_url','title','linkedin'];

    /**
     * Aggregated meta for companies
     *
     * @var array
     */
    protected $companies = [];

    /**
     * Aggregated meta for contacts
     *
     * @var array
     */
    protected $contacts = [];
    

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->argument('path_to_file'))
        {
            $files = [$this->argument('path_to_file')];
        } else
        {
            $files = array_map(function(\Symfony\Component\Finder\SplFileInfo $file) {
                return $file->getPathName();
            }, \File::allFiles(storage_path() . '/csvs'));
        }

        foreach ($files as $file) 
        {
            $this->info($file);
            $this->processCsv(Reader::createFromPath($file));
        }

        $this->createCompaniesMeta($this->companies);
        $this->createContactsMeta($this->contacts);
    }

    /**
     * Process csv contents.
     * Create Company and Contact entities from file contents
     * Load $this->companies and $this->contacts with meta information
     *
     * @param Reader $csv
     * @return bool
     */
    protected function processCsv(Reader $csv)
    {
        $headers = array_map(function($header) {
            return str_replace(' ','_',strtolower($header));
        }, $csv->fetchOne());

        $this->info('Verifying required columns exist...');
        if(!$this->headersAreValid($headers)) 
        {
            $this->error('This CSV does not have all of the required columns.');
            return false;
        }
        $this->info('All required fields are present.  Importing prospects...');

        foreach($csv->setOffset(1)->fetchAll() as $row) 
        {
            $line = array_combine($headers, $row);

            $imported = $this->importProspect($line);
            if($imported) {
                $this->fetchCompanyMeta($line);
                $this->fetchContactMeta($line);
            }
        }
    }

    /**
     * Extract Company and Contact data from csv row and save them to DB
     *
     * @param array $line array with file column names as keys and cell values as values
     * @return bool import results
     */
    protected function importProspect(array $line)
    {
        if($line['company_name'] == '')
        {
            $this->error('We do not have a company name. Skipping...');
            return false;
        }

        if($line['email'] == '')
        {
            $this->error('We do not have an email.  Skipping...');
            return false;
        }

        $company = Company::firstOrCreate(['name' => $line['company_name']]);
        if(isset($line['type']))
        {
            $company->type = $line['type'];
        }

        $contact = $company->contacts()->firstOrCreate(['email' => $line['email']]);
        if(isset($line['first_name']))
        {
            $contact->first_name = $line['first_name'];
        }
        if(isset($line['last_name']))
        {
            $contact->last_name = $line['last_name'];
        }
        
        $company->save();
        $contact->save();
        return true;
    }

    /**
     * Fetch contact meta from file line
     *
     * @param array $line array with file column names as keys and cell values as values
     * @return bool parsing results
     */
    protected function fetchContactMeta($line)
    {
        if($line['email'] == '')
        {
            return false;
        }

        foreach($this->contactMetaFields as $field)
        {
            if(isset($line[$field]))
            {
                $this->contacts[$line['email']][$field] = $line[$field];
            }
        }
    }

    /**
     * Fetch company meta from file line
     *
     * @param array $line array with file column names as keys and cell values as values
     * @return bool parsing results
     */
    protected function fetchCompanyMeta($line)
    {
        if($line['company_name'] == '')
        {
            return false;
        }

        foreach($this->companyMetaFields as $field)
        {
            if(isset($line[$field]))
            {
                $this->companies[$line['company_name']][$field] = $line[$field];
            }
        }
    }

    /**
     * Save companies metadata provided by argument array $companies
     *
     * @param array $companies companies
     */
    protected function createCompaniesMeta(array $companies)
    {
        $this->info('Processing company meta data...');
        foreach($companies as $name => $data)
        {
            $company = Company::where('name', $name)->first();
            \DB::table('company_metas')->where('company_id', $company->id)->delete();
            $meta = [];
            foreach($data as $key => $value)
            {
                if($value != '')
                {
                    $meta[] = new \CMV\Models\Prospector\CompanyMeta(['key' => $key, 'value' => $value]);
                }
            }
            $company->meta()->saveMany($meta);

        }
    }

    /**
     * Save contacts metadata provided by argument array $contacts
     *
     * @param array $contacts companies
     */
    protected function createContactsMeta(array $contacts)
    {
        $this->info('Processing contact meta data...');
        foreach($contacts as $email => $data)
        {
            $contact = Contact::where('email', $email)->first();
            \DB::table('contact_metas')->where('contact_id', $contact->id)->delete();

            $meta = [];
            foreach($data as $key => $value)
            {
                if($value != '')
                {
                    $meta[] = new \CMV\Models\Prospector\ContactMeta(['key' => $key, 'value' => $value]);
                }
            }
            $contact->meta()->saveMany($meta);
        }
    }

    /**
     * Check if all required headers exists in headers array
     *
     * @param array $headers array of headers needed to be validated
     * @return bool validation result
     */
    protected function headersAreValid(array $headers)
    {
        foreach($this->requiredColumns as $required) {
            if(!in_array($required, $headers)) {
                return false;
            }
        }
        return true;
    }


}

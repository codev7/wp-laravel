<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProspectorSeeder extends Seeder
{
    public function run()
    {   
        Model::unguard();

        /* Sales Reps */
        factory(CMV\User::class, 'sales_rep',3)->create();


        /* Companies */
        factory(CMV\Models\Prospector\Company::class,500)->create()->each(function($company){

            $company->meta()->saveMany( factory( CMV\Models\Prospector\CompanyMeta::class, rand(2,3))->make() );
            $company->salesRep()->associate( CMV\User::where('is_sales_rep',true)->random()->take(1)->first() );
            $company->save();

            $company->contacts()->saveMany( factory( CMV\Models\Prospector\Contact::class, rand(2,5))->make()->each(function($contact) use($company){

                $contact->save();
                $contact->meta()->saveMany( factory( CMV\Models\Prospector\ContactMeta::class, rand(2,5))->make() );
                
                
            }));

        });

        /* Activites */
        foreach(CMV\Models\Prospector\Contact::with('company')->random()->take(700)->get() as $contact)
        {

            $contact->activities()->saveMany( factory( CMV\Models\Prospector\Activity::class, rand(2,8))->make(['company_id' => $contact->company_id, 'sales_rep_id' => $contact->company->sales_rep_id]) );

        }

        Model::reguard();
    }
}

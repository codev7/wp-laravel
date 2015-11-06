<?php

namespace CMV\Http\Controllers\Prospector;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;
use CMV\Models\Prospector\Company;
use CMV\Models\Prospector\Contact;
use Input;

/**
 * @Controller(prefix="prospector")
 * @Middleware("sales-rep")
 */
class ProspectorController extends Controller
{

    /**
     * @Get("dashboard", as="prospector.dashboard")
     * @return Response
     */
    public function prospectsDashboard()
    {
        $unassigned = Company::unassignedCompanies();
        return view('prospector/dashboard')->with('unassigned',$unassigned)->with('reps', \CMV\User::where('is_sales_rep',true))->with('reps', \CMV\User::where('is_sales_rep',true)->with('companies')->get());
    }


    /**
     * @Get("companies/{filter?}/{rep?}", as="prospector.companies")
     * @return Response
     */
    public function companies($filter = null, $rep = null)
    {
        if(!$filter)
        {
            return redirect()->route('prospector.companies', ['filter' => 'all', 'rep' => $rep]);
        }


        $search = \Input::get('search');

        if($search) {
            $companies = Company::with('contacts','salesRep')->where('name','LIKE',"%{$search}%");
        } else {
            $companies = Company::with('contacts','salesRep');
        }
            
        $status = \Input::get('status');
        if($status) {
            
            $companies->where('status',$status);
            
        }

        if($rep)
        {   
            switch($rep) {
                case 'joe': $rep_id = 1; break;
                case 'connor': $rep_id = 2; break;
                case 'nate': $rep_id = 3; break;

            }
            $companies->where('sales_rep_id', $rep_id);   
        }
        

        if(in_array($filter, ['agency', 'brand']))
        {
            $companies->where('type', $filter);
        }

        if($filter == 'na')
        {
            $companies->whereNull('type');
        }


        return view('prospector/companies')->with('companies', $companies->paginate(50))->with('filter',$filter)->with('rep',$rep);
    }

    /**
     * @Get("company/{id}", as="prospector.company")
     * @return Response
     */
    public function company($id)
    {
        $company = Company::findOrFail($id);

        return view('prospector/company')->with('company', $company);
    }

    /**
     * @Get("contacts", as="prospector.contacts")
     * @return Response
     */
    public function contacts()
    {
        $search = Input::get('search');

        if($search) {
            $prospects = Contact::with('company','activities')
                ->where('contacts.email','LIKE',"%{$search}%")
                ->orWhere('contacts.first_name','LIKE',"%{$search}%")
                ->orWhere('contacts.last_name','LIKE',"%{$search}%");
        } else {
            $prospects = Contact::with('company','activities');
        }

        

        return view('prospector/contacts')->with('prospects', $prospects->paginate(50));
    }


    /**
     * @Post("company/{id}", as="prospector.update-company")
     * @return Response
     */
    public function updateCompany($id)
    {
        $company = Company::findOrFail($id);

        if(Input::get('status'))
        {
            $company->status = Input::get('status');
        }

        if(Input::get('type'))
        {
            $company->type = Input::get('type');
        }

        if(Input::get('sales_rep_id'))
        {
            $company->sales_rep_id = Input::get('sales_rep_id');
        }

        \Flash::success('<a href="'. route('prospector.company', ['id' => $company->id]) .'">'.$company->name .'</a> has been updated.');

        $company->save();

        return redirect()->back();
    }

    /**
     * @Get("company/{id}/person/{person_id}", as="prospector.contact")
     * @return Response
     */
    public function contact($id, $person_id)
    {
        $contact = Contact::with('company','activities')->findOrFail($person_id);

        return view('prospector/contact')->with('contact', $contact)->with('company', $contact->company)->with('activities', $contact->activities()->orderBy('created_at', 'desc')->get());
    }
}   

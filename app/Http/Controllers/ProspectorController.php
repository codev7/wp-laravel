<?php

namespace CMV\Http\Controllers;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

class ProspectorController extends Controller
{

    /**
     * @Get("prospects/dashboard", as="prospects.dashboard", middleware="sales_rep")
     * @return Response
     */
    public function prospectsDashboard()
    {
        $unassigned = CMV\Company::unassignedCompanies();
        return view('prospector/dashboard')->with('unassigned',$unassigned)->with('reps', CMV\User::where('is_sales_rep',true))->with('reps', CMV\User::where('is_sales_rep',true)->with('companies')->get());
    }


    /**
     * @Get("prospects/companies/{filter?}/{rep?}", as="companies", middleware="sales_rep")
     * @return Response
     */
    public function companies($filter = null, $rep = null)
    {
        if(!$filter)
        {
            return redirect()->route('companies', ['filter' => 'all', 'rep' => $rep]);
        }


        $search = Input::get('search');

        if($search) {
            $companies = CMV\Company::with('contacts','salesRep')->where('name','LIKE',"%{$search}%");
        } else {
            $companies = CMV\Company::with('contacts','salesRep');
        }
            
        $status = Input::get('status');
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
     * @Get("company/{id}", as="company", middleware="sales_rep")
     * @return Response
     */
    public function company($id)
    {
        $company = CMV\Company::findOrFail($id);

        return view('company')->with('company', $company);
    }

    /**
     * @Get("contacts", as="contacts", middleware="sales_rep")
     * @return Response
     */
    public function contacts()
    {
        $search = Input::get('search');

        if($search) {
            $prospects = CMV\Contact::with('company','activities')
                ->where('contacts.email','LIKE',"%{$search}%")
                ->orWhere('contacts.first_name','LIKE',"%{$search}%")
                ->orWhere('contacts.last_name','LIKE',"%{$search}%");
        } else {
            $prospects = CMV\Contact::with('company','activities');
        }

        

        return view('contacts')->with('prospects', $prospects->paginate(50));
    }


    /**
     * @Post("company/{id}", as="update-company", middleware="sales_rep")
     * @return Response
     */
    public function updateCompany($id)
    {
        $company = CMV\Company::findOrFail($id);

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

        Flash::success('<a href="'. route('company', ['id' => $company->id]) .'">'.$company->name .'</a> has been updated.');

        $company->save();

        return redirect()->back();
    }

    /**
     * @Get("company/{id}/person/{person_id}", as="prospect", middleware="sales_rep")
     * @return Response
     */
    public function contact($id, $person_id)
    {
        $contact = CMV\Contact::with('company','activities')->findOrFail($person_id);

        return view('contact')->with('contact', $contact)->with('company', $contact->company)->with('activities', $contact->activities()->orderBy('created_at', 'desc')->get());
    }

}   

<?php

namespace CMV\Http\Controllers;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

use CMV\Http\Requests\ValidateNewQuoteRequest;

use CMV\User;
use CMV\Lead;

use CMV\Jobs\SendLeadToSlack;

class LeadsController extends Controller
{   


    /**
     * Store a newly created resource in storage.
     * @Post("concierge/subscribe", as="concierge.subscribe")
     * @return Response
     */
    public function subscribeToConciergePlan(Request $request)
    {

        $user = User::firstOrCreate(['email' => $request->input('email')]);



        if($request->input('couponCode'))
        {
             $user->subscription( $request->input('plan') )
                ->withCoupon($request->input('couponCode') )
                ->create( $request->input('token'), [
                    'email' => $request->input('email')
                ]);
            
        }
        else
        {
             $user->subscription( $request->input('plan') )->create( $request->input('token'), [

                'email' => $request->input('email')

            ] );
        }
       



        $this->dispatch(new SendLeadToSlack("New WordPress Concierge Subscriber","#inbound-leads",[
            'text' => 'Make it rain.  :dancers:',
            'color' => 'good',
            'fields' => [
                [
                    'title' => 'Subscribed To',
                    'value' => $request->input('plan')
                ],
                [
                    'title' => 'Customer Email',
                    'value' => $user->email
                ]
            ]
        ]));

        return $user->email;
    }

    /**
     * Store a newly created resource in storage.
     * @Post("quote/new", as="lead.save")
     * @return Response
     */
    public function store(ValidateNewQuoteRequest $request)
    {   


        $user = User::firstOrCreate(['email' => $request->input('email')]);

        if($request->input('phone'))
        {
            $user->phone_number = $request->input('phone');
            $user->save();
        }


        if($request->input('name') && is_null($user->name))
        {
            $user->name = $request->input('name');
            $user->save();
        }


        $lead = $user->leads()->save( new Lead([
            'project_brief' => $request->input('project_brief'),
            'lead_deadline' => $request->input('lead_deadline'),
        ]));

        if($request->input('project_type'))
        {
            $lead->createOrFindProjectTypeId( $request->input('project_type') );    
        }
        
        if($request->input('files'))
        {
            $lead->files = $request->input('files');
            $lead->save();
        }

        $this->dispatch(new SendLeadToSlack("New Warm Lead","#inbound-leads",[
            'text' => 'Make it rain.  :dancers:',
            'color' => 'good',
            'fields' => [
                [
                    'title' => 'Project Type',
                    'value' => ($request->input('project_type')) ? $lead->type->name : null
                ],
                [
                    'title' => 'Customer Name',
                    'value' => $lead->user->getFullName()
                ],
                [
                    'title' => 'Customer Email',
                    'value' => $lead->user->email
                ],
                [
                    'title' => 'Brief',
                    'value' => $lead->project_brief
                ],
                [
                    'title' => 'Deadline',
                    'value' => $lead->lead_deadline
                ],
                [
                    'title' => 'Files',
                    'value' => isset($lead->files) ? implode(', ', $lead->files) : null
                ]
            ]
        ]));
        
        return ['status' => 'success', 'lead_id' => $lead->id];
    }
}

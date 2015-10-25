<?php

namespace CMV\Http\Controllers\PM;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

use CMV\User;
use Auth;
use CMV\Models\PM\ConciergeSite;

/**
 * @Controller(prefix="concierge-site")
 */
class ConciergeController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     * @Post("create", as="concierge.create")
     * @return Response
     */
    public function create(Request $request)
    {

        $site = Auth::user()->currentTeam()->conciergeSites()->create([
            'url' => $request->input('url'),
            'name' => $request->input('name')
        ]);


        $site->slug = strtolower(str_replace(' ','-',$site->name));

        $site->save();

        return redirect()->route('concierge.single', ['slug' => $site->slug]);
    }

    /**
     * Store a newly created resource in storage.
     * @Get("site/{slug}", as="concierge.single")
     * @return Response
     */
    public function single($slug)
    {

        $site = ConciergeSite::whereSlug($slug)->first();


        return view('concierge.single')->withSite($site);
    }



}

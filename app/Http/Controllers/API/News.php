<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\UserNews;
use Input, Validator, Auth;

class News extends Controller {

    /**
     * @Middleware("auth")
     * @Post("/api/news/{news}/view")
     * @param $id
     */
    public function view($id)
    {
        UserNews::markViewed(Auth::user(), $id);
    }

}
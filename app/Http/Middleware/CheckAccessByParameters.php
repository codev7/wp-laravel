<?php
namespace CMV\Http\Middleware;

use Access;
use CMV\Models\PM\Project, CMV\Models\PM\ConciergeSite;
use Illuminate\Http\Request;

class CheckAccessByParameters extends Middleware {

    public function handle(Request $request, $next)
    {
        $error = 'Permission error';

        $classes = [
            'projects' => Project::class,
        ];

        $levels = [
            'GET' => 'read',
            'POST' => 'update',
            'DESTROY' => 'delete',
        ];

        $allowed = true;
        foreach ($request->route()->parameters() as $name => $id) {
            if (isset($classes[$name])) {
                $model = $classes[$name]::find($id);
                $level = $levels[$request->method()];
                $allowed = $allowed && $model && Access::check($model, $level);
            }
        }

        if ($allowed) {
            return $next($request);
        }

        return $this->respondWithError($error);
    }

}
<?php
namespace CMV\Http\Middleware;

use Access;
use CMV\Models\PM\Project, CMV\Models\PM\ConciergeSite;
use CMV\Models\PM\ProjectBrief;
use Illuminate\Http\Request;

class CheckAccessByParameters extends Middleware {

    public function handle(Request $request, $next, $specificAction = [])
    {
        $error = 'Permission error';

        $classes = [
            'projects' => Project::class,
            'briefs' => ProjectBrief::class
        ];

        $actions = [
            'GET' => 'read',
            'PUT' => 'update',
            'DESTROY' => 'delete',
            'POST' => 'create'
        ];

        $uri = $request->route()->uri();
        $parts = explode('/', $uri);
        array_shift($parts);  // -> something like ['projects', 22, 'briefs']

        $allowed = true;
        for ($i=0; $i<count($parts); $i+=2) {
            $resource = $parts[$i];
            if (!isset($classes[$resource])) continue;

            $model = new $classes[$resource];
            $id = isset($parts[$i+1]) ? $request->route()->parameter($resource) : null;

            if ($id) {
                $model = $classes[$resource]::find($id);
                if (!$model) {
                    $allowed = false;
                    break;
                }
            }

            $action = isset($parts[$i+2]) && !isset($classes[$parts[$i+2]]) ?
                $parts[$i+2] :
                $actions[$request->method()];

            $allowed = $allowed && Access::check($model, $action);
            if (!$allowed) break;
        }

        if ($allowed) {
            return $next($request);
        }

        return $this->respondWithError($error);
    }

}
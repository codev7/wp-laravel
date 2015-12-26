<?php
namespace CMV\Http\Middleware;

use Access;
use CMV\Models\PM\Project;
use CMV\Models\PM\ToDo;
use Illuminate\Http\Request;

/**
 * Checks resource via Access facade. If route receives
 * a resource id it should be named 'projects', 'briefs', 'todos' etc
 * The middleware requires a parameter in form '{$resource_name}[:{$action}]'.
 * If action is not set then it's being guessed by the request method.
 *
 * Class CheckAccess
 * @package CMV\Http\Middleware
 * @Example @ Middleware("access:projects,read").
 */
class CheckAccess extends Middleware {

    public function handle(Request $request, $next, $type, $action = null)
    {
        $error = 'Permission error';

        $classes = [
            'projects' => Project::class,
            'project_briefs' => ProjectBrief::class,
            'todos' => ToDo::class,
        ];

        $actions = [
            'GET' => 'read',
            'PUT' => 'update',
            'DESTROY' => 'delete',
            'POST' => 'create'
        ];

        $allowed = false;
        if (isset($classes[$type])) {
            $id = $request->route($type);
            if ($id && !($model = $classes[$type]::find($id))) {
                return $this->respondWithError($error);
            } else {
                $model = new $classes[$type];
            }

            $action = $action ? $action : $actions[$request->method()];

            $allowed = Access::check($model, $action);
        }
        
        if ($allowed) {
            return $next($request);
        }

        return $this->respondWithError($error);
    }
}
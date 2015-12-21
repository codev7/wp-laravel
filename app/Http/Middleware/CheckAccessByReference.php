<?php
namespace CMV\Http\Middleware;

use Access;
use CMV\Models\PM\Project, CMV\Models\PM\ConciergeSite, CMV\Models\PM\ToDo;
use Illuminate\Http\Request;

class CheckAccessByReference extends Middleware {

    public function handle(Request $request, $next)
    {
        $error = 'Permission error';

        $refType = \Input::get('reference_type');
        $refId = \Input::get('reference_id');

        $refs = [
            'project' => Project::class,
            'project_brief' => ProjectBrief::class
        ];

        $actions = [
            'GET' => 'read',
            'PUT' => 'update',
            'DESTROY' => 'delete',
            'POST' => 'create'
        ];

        $allowed = false;

        if ($refId && isset($refs[$refType])) {
            $model = $refs[$refType]::find($refId);
            if ($model) {
                $action = $actions[$request->method()];
                $allowed = $allowed && Access::check($model, $action);
            }
        }

        if ($allowed) {
            return $next($request);
        }

        return $this->respondWithError($error);
    }
}
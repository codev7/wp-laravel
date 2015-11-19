<?php
namespace CMV\Http\Middleware;

use Access;
use CMV\Models\PM\Project, CMV\Models\PM\ConciergeSite, CMV\Models\PM\ToDo;
use Illuminate\Http\Request;

class CheckAccessByReference extends Middleware {

    public function handle(Request $request, $next)
    {
        $error = 'Permission error';

        $classes = [
            'project' => Project::class,
            'concierge_site' => ConciergeSite::class,
            'todo' => ToDo::class
        ];

        $levels = [
            'GET' => 'read',
            'POST' => 'update',
            'DESTROY' => 'delete',
        ];

        $input = $request->all();
        $refType = array_get($input, 'reference_type');
        $refId = array_get($input, 'reference_id');

        if (!isset($classes[$refType]) || !$refId) {
            return $this->respondWithError($error);
        }

        $model = $classes[$refType]::find($refId);
        $level = $levels[$request->method()];
        $allowed = $model && Access::check($model, $level);

        if ($allowed) {
            return $next($request);
        }

        return $this->respondWithError($error);
    }

}
<?php
namespace CMV\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Based off Caffeine package's middleware
 * Class WakeUpCSRFToken
 */
class WakeUpCSRFToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $content = null;
        $response = $next($request);

        if ($request->pjax()) {
            return $response;
        }

        if (! method_exists($response, 'getOriginalContent')) {
            return $response;
        }

        $content = $response->getOriginalContent();

        if (method_exists($content, 'render')) {
            $content = $content->render();
        }

        if (is_string($content)) {
            $content = str_replace('</body>', "
                <script>
                    setInterval(function() {
                        var e=window.XMLHttpRequest ?
                            new XMLHttpRequest :
                            new ActiveXObject('Microsoft.XMLHTTP');
                        e.open('GET','/genealabs/laravel-caffeine/drip',!0),e.send()
                    }," . config('genealabs-laravel-caffeine.dripIntervalInMilliSeconds', 300000) . ");
                </script>
            </body>", $content);

            $response->setContent($content);
        }

        return $response;
    }
}

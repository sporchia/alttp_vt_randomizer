<?php

namespace ALttP\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $segment = $request->segment(1);

        if (!in_array($segment, config('app.locales'))) {
            $segment = config('app.locale');
            return redirect("/$segment" . $request->getRequestUri(), 301);
        }

        app()->setLocale($segment);

        return $next($request);
    }
}

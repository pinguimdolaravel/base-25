<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckImpersonate
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($id = Session::get('impersonate_as')) {
            Context::add('impersonator_id', Auth::id());
            Context::add('impersonate_as', $id);

            Auth::onceUsingId($id);
        }

        return $next($request);
    }
}

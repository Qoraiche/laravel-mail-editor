<?php

namespace Qoraiche\MailEclipse\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\UnauthorizedException;

class Authenticate
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, $next)
    {
        if (!$request->user()) {
            throw new AuthenticationException;
        }

        if (
            !app()->runningInConsole()
            && App::environment(config('maileclipse.allowed_environments', ['local']))
        ) {
            throw new UnauthorizedException("Environment not Allowed. Currently in " . App::environment());
        }

        if (method_exists($request->user(), 'manageMailables')) {
            $request->user()->manageMailables() ?: throw new UnauthorizedException();
        }

        return $next($request);
    }
}

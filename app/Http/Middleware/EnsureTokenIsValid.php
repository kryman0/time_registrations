<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has("user")) {
            return response("User is not logged in", Response::HTTP_UNAUTHORIZED);
        }

        $token = $request->session()->get("user");

        try {
            if ($this->getAppKey() !== Crypt::decryptString($token)) {
                return response("App key is not valid", Response::HTTP_UNAUTHORIZED);
            }
        } catch (DecryptException $e) {
            return response('Could not validate user token: ' . $e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }

    private function getAppKey(): string {
        return env('APP_KEY', 'time_registrations');
    }
}

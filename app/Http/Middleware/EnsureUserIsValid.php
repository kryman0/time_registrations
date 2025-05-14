<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ssn = $request->post("ssn");
        $password = $request->post("password");

        $user = User::where('ssn', '=', $ssn)->first();

        if (!$user || !$this->isUserPasswordValid($user, $password)) {
            return response("Username or password is incorrect!", Response::HTTP_UNAUTHORIZED);
        }

        $request->session()->put("userId", $user->id);
        $request->session()->save();

        return $next($request);
    }

    private function isUserPasswordValid($user, string $password): bool {
        return Hash::check($password, $user->password);
    }
}

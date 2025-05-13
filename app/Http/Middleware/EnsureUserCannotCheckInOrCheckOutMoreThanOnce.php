<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureUserCannotCheckInOrCheckOutMoreThanOnce
{
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->post('id');
        $checkIn = $request->post('checkIn');
        $checkOut = $request->post('checkOut');

        if ($checkIn && $this->hasUserCheckedInOrCheckedOut($userId, 'has_checked_in')) {
            return response("You have already checked in!", Response::HTTP_BAD_REQUEST);
        }

        if ($checkOut && $this->hasUserCheckedInOrCheckedOut($userId, 'has_checked_out')) {
            return response("You have already checked out!", Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }

    private function hasUserCheckedInOrCheckedOut(int $userId, string $checkedInOrCheckedOut): bool {
        return User::find($userId)->timestamps()->firstWhere($checkedInOrCheckedOut, true);
    }
}

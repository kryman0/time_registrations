<?php

namespace App\Http\Middleware;

use App\Models\Timestamp;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCannotCheckInOrCheckOutMoreThanOnce
{
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->post('id');
        $checkIn = $request->post('check-in');
        $checkOut = $request->post('check-out');

        if ($checkIn && $this->hasUserCheckedInOrCheckedOut($userId, 'has_checked_in')) {
            return response("You have already checked in!", Response::HTTP_BAD_REQUEST);
        } else if ($checkOut && $this->hasUserCheckedInOrCheckedOut($userId, 'has_checked_out')) {
            return response("You have already checked out!", Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }

    private function hasUserCheckedInOrCheckedOut(int $userId, string $hasCheckedInOrCheckedOut): bool {
        $ts = Timestamp::where([
            ['user_id', '=', $userId],
            [ $hasCheckedInOrCheckedOut, '=', true]])
            ->orderByDesc('check_in')
            ->limit(1)
            ->get();

        return $ts->isNotEmpty();
    }
}

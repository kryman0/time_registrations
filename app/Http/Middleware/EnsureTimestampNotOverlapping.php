<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Timestamp;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTimestampNotOverlapping
{
    public function handle(Request $request, Closure $next): Response {
        $tsId = $request->post('id');
        $checkIn = $request->post('check_in');
        $checkOut = $request->post('check_out');
        $checkInTime = $request->post('check_in_time');
        $checkOutTime = $request->post('check_out_time');


        if ((!$checkIn && !$checkOut) && ($checkIn && $checkOut)) {
            return response('Please choose either check in or check out to modify!', Response::HTTP_FORBIDDEN);
        }

        $currTs = Timestamp::find($tsId);
        $prevTs = Timestamp::where('id', '<', $tsId)->orderByDesc('id')->limit(1)->get();
        $nextTs = Timestamp::where('id', '>', $tsId)->orderBy('id')->limit(1)->get();

        if ($checkIn && $this->isCheckInTimeOverlapping($checkInTime, $currTs, $prevTs)) {
            return response("Check in time can't be modified. Check in $currTs->check_in is greater than check out: $currTs->check_out", Response::HTTP_BAD_REQUEST);
        }

        if ($checkOut && $this->isCheckOutTimeOverlapping($checkOutTime, $currTs, $nextTs)) {
            return response("Check out time can't be modified. Check out $currTs->check_out is greater than check in: $currTs->check_out", Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }

    private function isCheckInTimeOverlapping(string $checkInTime, Timestamp $currTs, Timestamp $prevTs = null): bool {
        $checkInTime = date($checkInTime);
        $currCheckOutDate = date($currTs->check_out);

        if (!$prevTs) {
            return $checkInTime >= $currCheckOutDate;
        }

        $prevCheckOutDate = date($prevTs->check_out);

        return ($checkInTime >= $currCheckOutDate) || ($checkInTime <= $prevCheckOutDate);
    }

    private function isCheckOutTimeOverlapping(string $checkOutTime, Timestamp $currTs, Timestamp $nextTs = null): bool {
        $currCheckInDate = date($currTs->check_in);
        $checkOutTime = date($checkOutTime);

        if (!$nextTs) {
            return $checkOutTime <= $currCheckInDate;
        }

        $nextCheckInDate = date($nextTs->check_in);

        return ($checkOutTime <= $currCheckInDate) || ($checkOutTime >= $nextCheckInDate);
    }
}

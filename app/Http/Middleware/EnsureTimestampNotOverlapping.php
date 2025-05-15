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
        $prevTs = Timestamp::where('id', '<', $tsId)->orderByDesc('id')->limit(1)->get()->first();
        $nextTs = Timestamp::where('id', '>', $tsId)->orderBy('id')->limit(1)->get()->first();

        if ($checkIn && $this->isCheckInTimeOverlapping($checkInTime, $currTs, $prevTs)) {
            $prevMsg = $prevTs ? " or previous check out $prevTs->check_out" : "";
            $respMsg = "Check in $checkInTime can't be modified. It's either greater than check out $currTs->check_out" . $prevMsg;

            return response($respMsg, Response::HTTP_BAD_REQUEST);
        }

        if ($checkOut && $this->isCheckOutTimeOverlapping($checkOutTime, $currTs, $nextTs)) {
            $nextMsg = $nextTs ? " or next check in $nextTs->check_in" : "";
            $respMsg = "Check out $checkOutTime can't be modified. It's either greater than check in: $currTs->check_out" . $nextMsg;

            return response($respMsg, Response::HTTP_BAD_REQUEST);
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

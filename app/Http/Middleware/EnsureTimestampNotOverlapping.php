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

        if (!$checkIn && !$checkOut) {
            return response('Please choose either check in or check out to modify!', Response::HTTP_FORBIDDEN);
        }

        $currTs = Timestamp::find($tsId);
        $prevTs = Timestamp::where('id', '<', $tsId)->orderByDesc('id')->limit(1)->get();
        $nextTs = Timestamp::where('id', '>', $tsId)->orderBy('id')->limit(1)->get();

        if ($checkIn && $this->isCheckInTimeOverlapping($currTs, $prevTs)) {
            return response("Check in time can't be modified. Check in $currTs->check_in is greater than check out: $currTs->check_out", Response::HTTP_BAD_REQUEST);
        }

        //lägg till checkout

    }

    private function isCheckInTimeOverlapping(Timestamp $currTs, Timestamp $prevTs): bool {
        $currCheckInDate = date($currTs->check_in);
        $currCheckOutDate = date($currTs->check_out);
        $prevCheckOutDate = date($prevTs->check_out);

        return $currCheckInDate >= $currCheckOutDate || $currCheckInDate <= $prevCheckOutDate;
    }
}

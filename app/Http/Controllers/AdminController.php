<?php

namespace App\Http\Controllers;

use App\Models\Timestamp;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function showTimestamps(Request $request): Response {
        $timestamps = Timestamp::all()->sortByDesc('check_in')->toArray();

        $dictByCheckInDates = [];
        foreach ($timestamps as $value) {
            if (!key_exists($value['check_in'], $dictByCheckInDates)) {
                $dictByCheckInDates[$value['check_in']] = [];
            }

            $dictByCheckInDates[$value['check_in']][] = $value;
        }


        return response()->json($dictByCheckInDates)->setStatusCode(Response::HTTP_OK);
    }

    public function editTimestamp(Request $request): Response {
        $tsId = $request->post('id');
        $checkIn = $request->post('check_in_time');
        $checkOut = $request->post('check_out_time');

        $ts = Timestamp::find($tsId);
        $checkIn ? $ts->check_in = $checkIn : $ts->check_out = $checkOut;
        $ts->save();

        $resp = ($checkIn ? 'Check in ' : 'Check out ') . 'time successfully changed!';

        return response($resp, Response::HTTP_OK);
    }
}

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
            $date = date_create_immutable($value['check_in'])->format("Y-m-d");

            if (!key_exists($date, $dictByCheckInDates)) {
                $dictByCheckInDates[$date] = [];
            }

            $dictByCheckInDates[$date][] = $value;
        }

        return response()->json($dictByCheckInDates)->setStatusCode(Response::HTTP_OK);
    }

    public function editTimestamp(Request $request): Response {
        $id = $request->post('id');
        $checkIn = $request->post('check_in_time');
        $checkOut = $request->post('check_out_time');

        $ts = Timestamp::find($id);
        $checkIn ? $ts->check_in = $checkIn : $ts->check_out = $checkOut;
        $ts->save();

        $resp = ($checkIn ? 'Check in ' : 'Check out ') . 'time successfully changed!';

        return response($resp, Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Timestamp;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function showTimestamps(): Response {
        $timestamps = Timestamp::all()->groupBy(['check_in', 'user_id'])->sortByDesc(null, SORT_DESC)->toArray();

        return response()->json($timestamps, options: JSON_PRETTY_PRINT)->header('Content-Type', 'application/json');
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

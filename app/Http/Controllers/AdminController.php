<?php

namespace App\Http\Controllers;

use App\Models\Timestamp;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function showTimestamps(): Response {
        $timestamps = Timestamp::all()->sortDesc()->toArray();

        return response()->json($timestamps)->header('Content-Type', 'application/json');
    }

    public function editTimestamp(Request $request): Response {
        $tsId = $request->post('id');
        $checkIn = $request->post('check_in');
        $checkOut = $request->post('check_out');

        $currTs = Timestamp::find($tsId);
        $prevTs = Timestamp::where('id', '<', $tsId)->orderByDesc('id')->limit(1)->get();
        $nextTs = Timestamp::where('id', '>', $tsId)->orderBy('id')->limit(1)->get();

        if ($checkIn && date($currTs->check_in) >= date($currTs->check_out)) {
            return response("Check in time can't be modified. Check in $currTs->check_in is greater than check out: $currTs->check_out", Response::HTTP_BAD_REQUEST);
        }


        /*fetch ts by id from db and
        $usr = [ [ 'id' => 1, 'checkIn' => '2025-05-12 08:00:00', 'checkOut' => '2025-05-12 17:00:00', 'userId' => 1 ], [ 'id' => 2, 'checkIn' => '2025-05-13 08:00:00', 'checkOut' => '2025-05-13 17:00:00', 'userId' => 1] ];
        while ($arr = current($usr)) { if ($arr['id'] === 2) { echo $arr['id']; $arr = prev($usr); echo $arr['id']; break; } next($usr); }
        */

        return response('Time successfully changed!', 200);
    }
}

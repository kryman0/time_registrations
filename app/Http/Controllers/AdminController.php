<?php

namespace App\Http\Controllers;

use App\Models\Timestamp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller {
    public function show(): JsonResponse {
        $timestamps = Timestamp::all()->toArray();

        return response()->json($timestamps)->header('Content-Type', 'application/json');
    }

    public function editTimestamp(Request $request): Response {
        $tsId = $request->post("id");

        /*fetch ts by id from db and
        $usr = [ [ 'id' => 1, 'checkIn' => '2025-05-12 08:00:00', 'checkOut' => '2025-05-12 17:00:00', 'userId' => 1 ], [ 'id' => 2, 'checkIn' => '2025-05-13 08:00:00', 'checkOut' => '2025-05-13 17:00:00', 'userId' => 1] ];
        while ($arr = current($usr)) { if ($arr['id'] === 2) { echo $arr['id']; $arr = prev($usr); echo $arr['id']; break; } next($usr); }
        */

        return response('Time successfully changed.', 200);
    }
}

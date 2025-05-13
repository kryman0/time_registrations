<?php

namespace App\Http\Controllers;

use App\Models\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TimestampController extends Controller
{
    private function getCurrentTimeFormatted(): string {
        return date_create_immutable()->format('Y-m-d H:i:s');
    }
    public function checkIn(Request $request): Response {
        $userId = $request->post('userId');
        $latitude = $request->post('latitude');
        $longitude = $request->post('longitude');

        $date = $this->getCurrentTimeFormatted();

        Timestamp::create([
            'user_id' => $userId,
            'check_in' => $date,
            'has_checked_in' => true,
            'has_checked_out' => false,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        return response('Check in time registered!', Response::HTTP_OK);
    }

    public function checkOut(Request $request): Response {
        $userId = $request->post('userId');
        $latitude = $request->post('latitude');
        $longitude = $request->post('longitude');

        $date = $this->getCurrentTimeFormatted();

        Timestamp::create([
            'user_id' => $userId,
            'check_out' => $date,
            'has_checked_in' => false,
            'has_checked_out' => true,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        return response('Check out time registered!', Response::HTTP_OK);
    }
}

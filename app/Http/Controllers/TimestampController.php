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
        if ($request->has('check-out')) {
            return response('Wrong API: use "checkin" instead!', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $userId = $request->post('id');
        $latitude = $request->post('latitude_check_in');
        $longitude = $request->post('longitude_check_in');

        $date = $this->getCurrentTimeFormatted();

        $ts = Timestamp::create([
            'user_id' => $userId,
            'check_in' => $date,
            'has_checked_in' => true,
            'has_checked_out' => false,
            'latitude_check_in' => $latitude,
            'longitude_check_in' => $longitude,
        ]);

        $request->session()->put('timestamp', $ts);
        $request->session()->save();

        return response('Check in time registered!', Response::HTTP_OK);
    }

    public function checkOut(Request $request): Response {
        $ts = $request->session()->pull('timestamp');

        if (!$ts) {
            return response('You need to check in first!', Response::HTTP_BAD_REQUEST);
        }

        if ($request->has('check-in')) {
            return response('Wrong API: use "checkout" instead!', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $latitude = $request->post('latitude_check_out');
        $longitude = $request->post('longitude_check_out');

        $date = $this->getCurrentTimeFormatted();

        $ts->check_out = $date;
        $ts->has_checked_in = false;
        $ts->has_checked_out = true;
        $ts->latitude_check_out = $latitude;
        $ts->longitude_check_out = $longitude;
        $ts->save();

        return response('Check out time registered!', Response::HTTP_OK);
    }
}

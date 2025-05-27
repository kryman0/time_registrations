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
        if ($request->post('check_out')) {
            return response('Wrong API: use "checkin" instead!', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $userId = $request->post('id');
        $ts = Timestamp::all()->where('user_id', $userId)->sortByDesc('check_in')->first();

        if (!$ts->has_checked_in) {
            $latitude = $request->post('latitude_check_in');
            $longitude = $request->post('longitude_check_in');
            $date = $this->getCurrentTimeFormatted();

            Timestamp::create([
                'user_id' => $userId,
                'check_in' => $date,
                'has_checked_in' => true,
                'has_checked_out' => false,
                'latitude_check_in' => $latitude,
                'longitude_check_in' => $longitude,
            ]);

            return response('Check in time registered!', Response::HTTP_OK);
        }

        return response('Check in time is already registered!', Response::HTTP_CONFLICT);
    }

    public function checkOut(Request $request): Response {
        if ($request->post('check_in')) {
            return response('Wrong API: use "checkout" instead!', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $userId = $request->post('id');
        $ts = Timestamp::all()->where('user_id', $userId)->sortByDesc('check_in')->first();

        if (!$ts->has_checked_out) {
            $latitude = $request->post('latitude_check_out');
            $longitude = $request->post('longitude_check_out');
            $date = $this->getCurrentTimeFormatted();

            $hasRowBeenUpdated = $ts->update([
                'check_out' => $date,
                'has_checked_in' => false,
                'has_checked_out' => true,
                'latitude_check_out' => $latitude,
                'longitude_check_out' => $longitude,
            ]);

            if (!$hasRowBeenUpdated) {
                return response('Could not save the check out time!', Response::HTTP_BAD_REQUEST);
            }

            return response('Check out time registered!', Response::HTTP_OK);
        }

        return response('You need to check in first!', Response::HTTP_BAD_REQUEST);
    }
}

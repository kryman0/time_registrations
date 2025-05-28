<?php

namespace App\Http\Controllers;

use App\Models\Timestamp;
use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function getEncryptedToken(): string {
        $appKey = env('APP_KEY', 'time_registrations');

        return Crypt::encryptString($appKey);
    }

    public function changePassword(Request $request): Response {
        $userId = $request->post('id');
        $password = $request->post('password');

        if (!strval($password)) {
            return response('Password is required!', Response::HTTP_BAD_REQUEST);
        }

        try {
            $hashedPassword = Hash::make($password);
            User::where('id', $userId)->update(['password' => $hashedPassword]);
        } catch (\Exception $e) {
            return response('Could not save password! ' . $e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return response('Password has been changed!', Response::HTTP_OK);
    }

    public function login(Request $request): Response {
        $userId = $request->session()->get("userId");
        $request->session()->remove("userId");

        $token = $this->getEncryptedToken();

        return response()->json(['userId' => $userId, 'token' => $token])->setStatusCode(Response::HTTP_OK);
    }

    public function account(int $userId): Response {
        $data = Timestamp::all()->where('user_id', $userId)->sortByDesc('check_in')->toArray();
//        var_dump($data);
//        $data = array_values($data);
//        var_dump($data);


        if (!$data) {
            return response('No check in has been registered yet!');
        }

//        $data = json_encode($data);

        return response()->json($data)->header('Content-Type', 'application/json')->setStatusCode(Response::HTTP_OK);
//        return response("hello", 200)->header('Content-Type', 'text/plain');
    }
}

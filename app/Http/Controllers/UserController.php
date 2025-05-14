<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function login(Request $request): RedirectResponse {
        $userId = $request->session()->get("userId");
        $request->session()->remove("userId");

        $token = $this->getEncryptedToken();

        $request->session()->put("user", $token);
        $request->session()->save();

        return redirect()->route("user.account", $userId);
    }

    public function account(int $userId, Request $request): JsonResponse {
        // hämta users tidsrapporteringar; lägg till i db
        $data = User::find($userId)->timestamps;
        var_dump($userId, $data);

        return response()->json($data);
    }
}

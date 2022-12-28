<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            if (
                !$request["fullName"] ||
                !$request["username"] ||
                !$request["password"]
            ) {
                return response()->json([
                    'success' => false,
                    'message' => "field tidak boleh kosong!",

                ], 400);
            }

            $user =  User::create([
                'full_name' => $request["fullName"],
                'username' => $request["username"],
                'password' => Hash::make($request["password"]),
            ]);

            $cookie = cookie('user_id', $user["id"], 6000 * 24);

            return response()->json([
                'success' => true,
                'message' => "Registrasi berhasil!",

            ], 201)->withCookie($cookie);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Internal Server Error",

            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            if (!$request['username'] || !$request['password']) {
                return response()->json([
                    'success' => false,
                    'message' => "Email atau password tidak boleh kosong!",

                ], 400);
            };
            $user = User::where("username", $request['username'])->first();

            if (
                !$user ||
                !password_verify(
                    $request['password'],
                    $user["password"]
                )
            ) {
                return response()->json([
                    'success' => false,
                    'message' => "Email atau password salah!",

                ], 401);
            }

            $cookie = cookie('user_id', $user["id"], 6000 * 24);

            return response()->json([
                'success' => true,
                'message' => "Login berhasil!",

            ], 200)->withCookie($cookie);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Internal Server Error",

            ], 500);
        }
    }
}

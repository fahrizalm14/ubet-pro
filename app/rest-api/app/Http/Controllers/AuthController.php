<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientException;
use App\Exceptions\UnauthenticatedException;
use App\Models\User;
// use App\Services\Interfaces\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // private UserService $userService;
    // public function __construct(UserService $userService)
    // {
    //     $this->userService = $userService;
    // }
    public function register(Request $request)
    {
        try {
            if (
                !$request["fullName"] ||
                !$request["username"] ||
                !$request["password"]
            ) {
                throw new ClientException("Field tidak boleh kosong.");
            }
            $user = [];
            try {
                $user = User::create([
                    'full_name' => $request["fullName"],
                    'username' => $request["username"],
                    'password' => Hash::make($request["password"]),
                ]);
            } catch (Exception $e) {
                throw new ClientException("Username tidak tersedia.");
            }


            $cookie = cookie('user_id', $user["id"], 6000 * 24);

            return $this
                ->renderSuccess("Registrasi berhasil.", [], 201)
                ->cookie($cookie);
        } catch (Exception $e) {

            return $this
                ->renderError($e)
                ->cookie(cookie()->forget("user_id"));
        }
    }

    public function login(Request $request)
    {
        try {
            if (!$request['username'] || !$request['password']) {
                throw new ClientException();
            }
            ;
            $user = User::where("username", $request['username'])->first();

            if (
                !$user ||
                !password_verify(
                    $request['password'],
                    $user["password"]
                )
            ) {
                throw new UnauthenticatedException();
            }

            $cookie = cookie('user_id', $user["id"], 6000 * 24);

            return $this
                ->renderSuccess("Login berhasil.", [], 200)
                ->cookie($cookie);
        } catch (Exception $e) {
            return $this
                ->renderError($e)
                ->cookie(cookie()->forget("user_id"));
        }
    }

    public function logout(Request $request)
    {
        try {
            return $this
                ->renderSuccess("Logout berhasil.", [], 200)
                ->withoutCookie($request->cookie("user_id"));
        } catch (Exception $e) {
            return $this
                ->renderError($e)
                ->withoutCookie($this->cookie("user_id"));
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $adminDetails = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $admin = Admin::create($adminDetails);
        $token = $admin->createToken('login_token')->plainTextToken;
        $response = ['admin' => $adminDetails, 'token' => $token];
        return response($response, 201);
    }
}

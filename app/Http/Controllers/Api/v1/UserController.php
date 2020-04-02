<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use  App\User;
class UserController extends Controller
{

    public function __construct()
    {

    }

    public function profile(Request $request)
    {
        return response()->json(['data' => Auth::user()], 200);
    }


}

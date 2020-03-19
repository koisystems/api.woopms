<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;

class PingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function ping() {
        return response()->json(['status'=> 'success'], 200);
    }
}

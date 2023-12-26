<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Worker;
class UserController extends Controller
{
    public function workers()
    {
        $workers = Worker::all();

        return response()->json([
            'details' => $workers
        ]);
    }
}

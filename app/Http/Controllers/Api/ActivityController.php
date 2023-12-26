<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Store;
use App\Models\ActivityWorker;
use JWTAuth;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
class ActivityController extends Controller
{
    public function addActivity(Request $request)
    {
        // $user = JWTAuth::authenticate($request->token);
        // return $user;
        // if($user == null){
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        
        $validatedData = Validator::make($request->all(), [
            'worker_id'   => ['required'],
            'category_id' => ['required'],
            'count'       => ['required'],
            'date'        => ['required'],
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        }
        $data = [
            'worker_id'   => $request->worker_id,
            'category_id' => $request->category_id,
            'count'       => $request->count,
            'date'        => $request->date,
        ];
        ActivityWorker::create($data);
        $product_in_store = Store::find($request->category_id);
        $product_in_store->count +=$request->count;
        $product_in_store->save();
        return response()->json([
            'details' => 'added successfully'
        ]);
    }
}

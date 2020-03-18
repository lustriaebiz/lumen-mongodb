<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Validator;

use Illuminate\Contracts\Event\Dispatcher;


/**
 * @OA\Post(
 *     path="/redis/set",
 *     summary="Set Data",
 *     tags={"Redis"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="gender",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="age",
 *                     type="number"
 *                 ),
 *                 example={"name": "Lustria Ebiz", "gender": "Male", "age": 24}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 * )
 */

 
 /**
 * @OA\Get(
 *     path="/redis/get",
 *     summary="Get Data",
 *     tags={"Redis"},
 *     @OA\Response(response="200", description="OK"),
 * )
 */
 

/**
 * @OA\Post(
 *     path="/redis/publish",
 *     summary="Publish Data",
 *     tags={"Redis"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="channel",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string"
 *                 ),
 *                 example={"channel": "chanel-1022", "message": "Hay bro"}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 * )
 */
 
  /**
 * @OA\Delete(
 *     path="/redis/destroy",
 *     summary="Delete Data",
 *     tags={"Redis"},
 *     @OA\Response(response="200", description="An example resource"),
 * )
 */

class RedisController extends Controller
{
    public function setter(Request $request) {
        
        /** validate */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'age' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['success' => false, 'message' => 'Validation errors', 'data' =>  $validator->errors()], 422);
        }
        
        Redis::set('dataset', json_encode($request->all()));

        // Redis::mset($request->all());

        return response()->json(['success' => true, 'message' => 'success set data']);
    }

    public function getter() {
        $data = Redis::get('dataset');

        return response()->json(['success' => true, 'message' => 'success get data', 'data' => $data]);
    }

    public function destroy(Request $request) {
        Redis::del('dataset');
        $data = Redis::get('dataset');

        return response()->json(['success' => true, 'message' => 'success destroy data', 'data' => $data]);
    }

    public function publish(Request $request) {
        $channel = $request->get('channel');
        $data = $request->get('message'); 

        Redis::publish($channel, $data);

        return response()->json(['success' => true, 'message' => 'success publish data']);
    }

}

// https://scotch.io/tutorials/getting-started-with-redis-in-php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Validator;

/** models */
use App\Models\Cars;

class CarsController extends Controller
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

    //

    public function list(){

        try {

            $data = Cache::remember("cars_all", 10 * 60, function () {
                return Cars::all();
            });

            if($data->count() > 0) {
                $data->map(function($dt) {
                    $dt->price = number_format($dt->price);
                });
            }
    
            return response()->json(['success' => true, 'message' => 'Success get data.', 'data' => $data], 200);
        
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th, 'data' => null], 500);
        }
    }

    
    public function detail($id){
        try {
            $data = Cars::find($id);

            /** validation data is exist */
            if(is_null($data)) 
                return response()->json(['success' => false, 'message' => 'Data not found.', 'data' => null], 200);


            return response()->json(['success' => true, 'message' => 'Success get data.', 'data' => $data], 200);
        
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th, 'data' => null], 500);
        }
    }

    public function store(Request $request) {

        try {

            /** validate */
            $validator = Validator::make($request->all(), [
                'carcompany' => 'required',
                'name' => 'required',
                'price' => 'required'
            ]);

            if($validator->fails()){
                return response()->json(['success' => false, 'message' => 'Validation errors', 'data' =>  $validator->errors()], 422);
            }

            /** request */
            $input  = $request->all();

            /** proccess */
            $car = new Cars();

            $car->carcompany    = $input['carcompany'];
            $car->name          = $input['name'];
            $car->price         = $input['price'];    

            /** execute & response */
            if(!$car->save())
                return response()->json(['success' => false, 'message' => 'Failed store data.', 'data' => null], 500);
            
            return response()->json(['success' => true, 'message' => 'Success store data.', 'data' => null], 200);

        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th, 'data' => null], 500);
        }

    }

    public function update(Request $request, $id) {
        try {

            /** validate */
            $validator = Validator::make($request->all(), [
                'carcompany' => 'required',
                'name' => 'required',
                'price' => 'required'
            ]);

            if($validator->fails()){
                return response()->json(['success' => false, 'message' => 'Validation errors', 'data' =>  $validator->errors()], 422);
            }

            /** request */
            $input  = $request->all();
            
            /** get data */
            $data = Cars::find($id);

            /** validation data is exist */
            if(is_null($data)) 
                return response()->json(['success' => false, 'message' => 'Data not found.', 'data' => null], 200);

            /** set */
            $data->carcompany    = $input['carcompany'];
            $data->name          = $input['name'];
            $data->price         = $input['price'];    

            /** execute & response */
            if(!$data->save())
                return response()->json(['success' => false, 'message' => 'Failed update data.', 'data' => null], 500);
            
            return response()->json(['success' => true, 'message' => 'Success update data.', 'data' => null], 200);

        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th, 'data' => null], 500);
        }
    }

    public function destroy($id) {
        try {
            
            $data = Cars::find($id);
            
            /** validation data is exist */
            if(is_null($data)) 
                return response()->json(['success' => false, 'message' => 'Data not found.', 'data' => null], 200);


            if(!$data->delete()) 
                return response()->json(['success' => false, 'message' => 'Failed destroy data.', 'data' => null], 500);
            
            return response()->json(['success' => true, 'message' => 'Success destroy data.', 'data' => null], 200);
        
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th, 'data' => null], 500);
        }

    }
}

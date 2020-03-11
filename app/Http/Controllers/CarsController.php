<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/** models */
use App\Cars;

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
            $data = Cars::all();

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

    public function store(Request $request) {

        try {

            /** request */
            $carcompany = $request->input('carcompany');
            $name       = $request->input('name');
            $price      = $request->input('price');

            /** proccess */
            $car = new Cars();

            $car->carcompany    = $carcompany;
            $car->name          = $name;
            $car->price         = $price;    

            /** execute & response */
            if(!$car->save())
                return response()->json(['success' => false, 'message' => 'Failed store data.', 'data' => null], 500);
            
            return response()->json(['success' => true, 'message' => 'Success store data.', 'data' => null], 200);

        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th, 'data' => null], 500);
        }

    }

    public function destroy($id) {
        try {
            
            $data = Cars::find($id);

            if(!$data->delete()) 
                return response()->json(['success' => false, 'message' => 'Failed destroy data.', 'data' => null], 500);
            
            return response()->json(['success' => true, 'message' => 'Success destroy data.', 'data' => null], 200);
        
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th, 'data' => null], 500);
        }

    }
}
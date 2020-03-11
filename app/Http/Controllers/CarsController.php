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
                return response()->json(['success' => false, 'message' => 'Failed store data.'], 500);
            
            return response()->json(['success' => true, 'message' => 'Success store data.'], 200);

        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th], 500);
        }

    }
}

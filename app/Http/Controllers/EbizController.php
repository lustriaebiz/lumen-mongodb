<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ebiz;


use App\Http\Transformers\EbizTransformer;
use App\Http\Transformers\IlluminatePaginatorAdapter;

 /**
 * @OA\Get(
 *     path="/ebiz",
 *     summary="Get all data",
 *     tags={"Fractal"},
 *     @OA\Response(response="200", description="OK"),
 *     security={{ "apiAuth": {} }}
 * )
 */

class EbizController extends Controller
{
    
    public function index()
    {
        $paginator = Ebiz::paginate(10);
        $ebiz = $paginator->getCollection();
 
        $response = fractal()
                    ->collection($ebiz, new EbizTransformer())
                    ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                    ->toArray();
 
        return response()->json($response);
    }

    
    public function create()
    {
        $ebiz = new Ebiz;
        $ebiz->data = 'haha';
        $ebiz->save();

        return response()->json(['success' => true]);
    }

}

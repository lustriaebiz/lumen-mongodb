<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


 /**
 * @OA\Get(
 *     path="/permission/list",
 *     summary="Get all permission",
 *     tags={"Permission"},
 *     @OA\Response(response="200", description="OK"),
 *     security={{ "apiAuth": {} }}
 * )
 */

class PermissionController extends Controller
{

    public function list() {
        $data = Permission::all()->pluck('name');

        return response()->json(['success' => true, 'message' => 'Get all permission success.',  'data' => $data]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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

  /**
 * @OA\Post(
 *     path="/permission/create",
 *     summary="Create Permission",
 *     tags={"Permission"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="role",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="permissions",
 *                     type="string"
 *                 ),
 *                 example={"role":"subscriber", "permissions": {"view_article","like_article"}}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 *     security={{ "apiAuth": {} }}
 * )
 */


class PermissionController extends Controller
{

    public function store(Request $request) {
        
        try {

            $role = Role::where(['name' => $request->get('role')])->first();
            
            if($role) {
                $permissions    = $request->get('permissions');

                if(is_array($permissions) && count($permissions) > 0) {

                    foreach ($permissions as $key => $value) {
                        $permission = new Permission;
                        $permission->name = $value;
                        $permission->save();
                    }

                    $role->givePermissionTo($permissions);
                    $permission->assignRole($role);
                }

                return response()->json(['success' => true, 'message' => 'Create permission success.']);

            }else{
                return response()->json(['success' => false, 'message' => 'Create permission failed, role not found']);
            }

        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Create permission false.']);
        }

    }

    public function list() {
        $data = Permission::all();

        return response()->json(['success' => true, 'message' => 'Get all permission success.',  'data' => $data]);
    }
}

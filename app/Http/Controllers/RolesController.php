<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


 /**
 * @OA\Get(
 *     path="/roles",
 *     summary="Get all roles",
 *     tags={"Roles"},
 *     @OA\Response(response="200", description="OK"),
 *     security={{ "apiAuth": {} }}
 * )
 */


  /**
 * @OA\Post(
 *     path="/roles",
 *     summary="Create Roles & Permission",
 *     tags={"Roles"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="role_name",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="permission_name",
 *                     type="string"
 *                 ),
 *                 example={"role_name":"writer", "permission_name":"add_artikel"}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 *     security={{ "apiAuth": {} }}
 * )
 */

class RolesController extends Controller
{
    
    
    public function CreateRolePermission(Request $request) {

        $role = new Role;
        $role->name = $request->get('role_name');
        $role->save();
        
        $permission = new Permission;
        $permission->name = $request->get('permission_name');
        $permission->save();

        /** 
         * fungsi untuk menambahkan permission
         */
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        /**
         * assign multiple permission
         */
        // $role->syncPermissions($permissions);
        // $permission->syncRoles($roles);

        /** 
         * fungsi untuk remove permission: 
        */
        // $role->revokePermissionTo($permission);
        // $permission->removeRole($role)

        return response()->json(['success' => true, 'message' => 'Create role permission success.']);


    }

    public function list() {
        $data = Role::all()->pluck('name');

        return response()->json(['success' => true, 'message' => 'Get all roles success.',  'data' => $data]);
    }
}

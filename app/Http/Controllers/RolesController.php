<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\RoleHasPermission;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


 /**
 * @OA\Get(
 *     path="/roles/list",
 *     summary="Get all roles",
 *     tags={"Roles"},
 *     @OA\Response(response="200", description="OK"),
 *     security={{ "apiAuth": {} }}
 * )
 */


  /**
 * @OA\Post(
 *     path="/roles/create-with-permissions",
 *     summary="Create Roles & Permission",
 *     tags={"Roles"},
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

class RolesController extends Controller
{
    
    
    public function CreateRolePermissions(Request $request) {

        $role = new Role;
        $role->name = $request->get('role');
        $role->save();
        
        $permissions = $request->get('permissions');

        if(is_array($permissions) && count($permissions) > 0) {

            foreach ($permissions as $key => $value) {
                $permission = new Permission;
                $permission->name = $value;
                $permission->save();
            }

            $role->givePermissionTo($permissions);
            $permission->assignRole($role);
        }


        return response()->json(['success' => true, 'message' => 'Create role permission success.']);

    }

    public function list() {
        $data = Role::all();

        $data->map(function($data) {
            $data['permission'] = RoleHasPermission::join('permissions', 'permissions.id', '=', 'role_has_permissions.role_id')
                                    ->where(['role_id' => $data['id']])->get();
        });

        return response()->json(['success' => true, 'message' => 'Get all roles success.',  'data' => $data]);
    }
}

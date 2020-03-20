<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Validator;
use App\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


 /**
 * @OA\Get(
 *     path="/spatie/roles",
 *     summary="Get Role & Permission By Token ",
 *     tags={"Spatie"},
 *     @OA\Response(response="200", description="OK"),
 *     security={{ "apiAuth": {} }}
 * )
 */

  /**
 * @OA\Post(
 *     path="/spatie/roles",
 *     summary="Create Roles & Permission",
 *     tags={"Spatie"},
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

 /**
 * @OA\Post(
 *     path="/jwt/token",
 *     summary="Create token",
 *     tags={"JWT"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 example={"user_id":2,"email":"ebislustria@gmail.com","is_active":true}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource")
 * )
 */

  /**
 * @OA\Post(
 *     path="/jwt/decode",
 *     summary="Decode token",
 *     tags={"JWT"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 example={"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJFYml6Iiwic3ViIjoiTHVtZW4gVG9rZW4gSldUIiwiaWF0IjoxNTgzOTkyODQwLCJleHAiOjE1ODM5OTY0NDAsInVzZXIiOnsidXNlcl9pZCI6MiwiZW1haWwiOiJlYmlzbHVzdHJpYUBnbWFpbC5jb20iLCJpc19hY3RpdmUiOnRydWV9LCJkZXNjIjoiIn0.fHCDAVz9krhIoz8_YTgyIhunjvCFibBH_wgYjDAshQI"}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource")
 * )
 */

    
class UserController extends Controller
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

    public function GetRolePermission(Request $request) {
        
        $user_id    = $request->get('auth')['user']->user_id;
        $user       = User::find($user_id);

        // $data['permission_via_roles']   = $user->getPermissionsViaRoles();
        // $data['direct_permission']      = $user->getDirectPermissions();
        
        $data['roles']          = $user->getRoleNames();
        $data['permission']     = $user->getPermissionNames();
        $data['all_permission'] = $user->getAllPermissions();

        return response()->json(['success' => true, 'message' => 'Get roles success.', 'data' => $data]);
    }
    
    public function encode(Request $request) {

        /** request */
        $input  = $request->all();

        $payload = [
            'iss'   => 'Ebiz', 
            'sub'   => 'Lumen Token JWT', 
            'iat'   => time(),
            'exp'   => time() + 120*60, 
            'data'  => $input,
            'desc'  => ''
          ];
          
          $jwt = JWT::encode($payload, env('JWT_SECRET'));
          
          $success      = true;
          $message      = 'Create Token succeed';
          $user_data    = [];
          
          return response()->json(['success'=>$success, 'message'=>$message, 'token'=>$jwt, 'data'=> $input]);
    }

    
    public function decode(Request $request) {

        /** validate */
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['success' => false, 'message' => 'Validation errors', 'data' =>  $validator->errors()], 422);
        }

        /** request */
        $input  = $request->all();
        
        $decoded = JWT::decode($input['token'], env('JWT_SECRET'), array('HS256'));
        
        $success    = true;
        $message    = 'Decode succeed';
        $data       = $decoded;
        
        return response()->json(['success'=>$success, 'message'=>$message, 'data'=>$data]);
    }
}


// note
// https://docs.spatie.be/laravel-permission/v3/basic-usage/basic-usage/
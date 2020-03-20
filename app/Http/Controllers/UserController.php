<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Validator;
use App\User;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


 /**
 * @OA\Get(
 *     path="/user/role-permissions",
 *     summary="User Has Role Permissions",
 *     tags={"User"},
 *     @OA\Response(response="200", description="OK"),
 *     security={{ "apiAuth": {} }}
 * )
 */

 
 /**
 * @OA\Post(
 *     path="/user/assign-role-permission",
 *     summary="Assign role and permission to user",
 *     tags={"User"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="role",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="permission",
 *                     type="string"
 *                 ),
 *                 example={"role": {"editor"}, "permission" : {"edit_article","view_article"}}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 *     security={{ "apiAuth": {} }}
 * )
 */
 
 /**
 * @OA\Post(
 *     path="/user/remove-role-permission",
 *     summary="Rovoke permissions to user",
 *     tags={"User"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="role",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="permission",
 *                     type="string"
 *                 ),
 *                 example={"role": "editor", "permission" : {"edit_article","view_article"}}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 *     security={{ "apiAuth": {} }}
 * )
 */
 
 /**
 * @OA\Post(
 *     path="/user/give-permissions",
 *     summary="Give permissions to user",
 *     tags={"User"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="permission",
 *                     type="string"
 *                 ),
 *                 example={"permission": {"edit_article", "view__article"}}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 *     security={{ "apiAuth": {} }}
 * )
 */
 
 /**
 * @OA\Post(
 *     path="/user/revoke-permissions",
 *     summary="Rovoke permissions to user",
 *     tags={"User"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="permission",
 *                     type="string"
 *                 ),
 *                 example={"permission": {"edit_article", "view__article"}}
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
 *                 example={"user_id":1,"email":"ebislustria@gmail.com","is_active":true}
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

    public function assignRolePermissions(Request $request) {

        try {
        
            Auth::user()->assignRole($request->get('role'));
            Auth::user()->givePermissionTo($request->get('permission'));

            /** up to date roles */
            $data = UserController::hasRole();
            // 

            return response()->json(['success' => true, 'message' => 'Success assign role', 'data' => $data]);
        
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Failed assign role, there is no role named for guard `api`.', 'data' => $th]);
        
        }

    }
    public function removeRolePermissions(Request $request) {

        try {
        
            Auth::user()->revokePermissionTo($request->get('permission'));
            Auth::user()->removeRole($request->get('role'));

            /** up to date roles */
            $data = UserController::hasRole();
            // 

            return response()->json(['success' => true, 'message' => 'Success remove role', 'data' => $data]);
        
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Failed remove role, there is no role named for guard `api`.', 'data' => $th]);
        
        }

    }

    public function hasRolePermissions(Request $request) {
        
        $user_id = Auth::user()->id;
        
        /** up to date roles */
        $data = UserController::hasRole();

        return response()->json(['success' => true, 'message' => 'Get roles success.', 'data' => $data]);
    }

    public function givePermissions(Request $request) {

        try {

            Auth::user()->givePermissionTo($request->get('permission'));

            /** up to date roles */
            $data = UserController::hasRole();
            // 

            return response()->json(['success' => true, 'message' => 'Success give permission', 'data' => $data]);
        
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Failed give permission, there is no permission named for guard `api`.', 'data' => $th]);
        
        }

    }

    public function revokePermissions(Request $request) {

        try {

            Auth::user()->revokePermissionTo($request->get('permission'));

            /** up to date roles */
            $data = UserController::hasRole();
            // 

            return response()->json(['success' => true, 'message' => 'Success revoke permission', 'data' => $data]);
        
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Failed revoke permission, there is no permission named for guard `api`.', 'data' => $th]);
        
        }

    }

    public static function hasRole() {

        $data['user']                   = Auth::user();
        $data['permission_via_roles']   = Auth::user()->getPermissionsViaRoles();
        $data['roles']                  = Auth::user()->getRoleNames();
        $data['permission']             = Auth::user()->getPermissionNames();

        return $data;
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
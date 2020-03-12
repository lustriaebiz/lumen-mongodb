<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/** Swagger Documentation API */

 /**
 * @OA\Get(
 *     path="/cars/list",
 *     summary="List of Cars",
 *     tags={"Cars"},
 *     @OA\Response(response="200", description="OK"),
 *     security={{ "apiAuth": {} }}
 * )
 */

  /**
 * @OA\Post(
 *     path="/cars/store",
 *     summary="Create of Cars",
 *     tags={"Cars"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="carcompany",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="price",
 *                     type="number"
 *                 ),
 *                 example={"carcompany": "Ferrari", "name": "Pista", "price": 82100000}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 *     security={{ "apiAuth": {} }}
 * )
 */
 
  /**
 * @OA\Put(
 *     path="/cars/update/{id}",
 *     summary="Update of Cars",
 *     tags={"Cars"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="document _id",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="carcompany",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="price",
 *                     type="number"
 *                 ),
 *                 example={"carcompany": "Ferrari", "name": "Pista", "price": 82100000}
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 *     security={{ "apiAuth": {} }}
 * )
 */
 
  /**
 * @OA\Delete(
 *     path="/cars/destroy/{id}",
 *     summary="Delete of Cars",
 *     tags={"Cars"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="document _id",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 *     security={{ "apiAuth": {} }}
 * )
 */

  /**
 * @OA\Get(
 *     path="/cars/detail/{id}",
 *     summary="Get of Cars by id",
 *     tags={"Cars"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="document _id",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(response="200", description="An example resource"),
 *     security={{ "apiAuth": {} }}
 * )
 */

class Cars extends Eloquent 
{

    protected $connection = 'mongodb';
    protected $collection = 'cars';

    protected $primaryKey = '_id';
    
    protected $fillable = [
        'company', 'name','price'
    ];

    protected $hidden = ['updated_at', 'created_at'];
}
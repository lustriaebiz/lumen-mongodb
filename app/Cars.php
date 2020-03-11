<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

 /**
 * @OA\Get(
 *     path="/cars/list",
 *     summary="List of Cars",
 *     tags={"Cars"},
 *     @OA\Response(response="200", description="OK")
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
 *     @OA\Response(response="200", description="An example resource")
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
 *     @OA\Response(response="200", description="An example resource")
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
 *     @OA\Response(response="200", description="An example resource")
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
<?php

namespace App\Http\Transformers;

use App\Models\Ebiz;
use League\Fractal;

class EbizTransformer extends Fractal\TransformerAbstract
{
	public function transform(Ebiz $ebiz)
	{
	    return [
	        'id'      => (string) $ebiz->id,
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/ebiz/'.$ebiz->id,
                ]
            ],
	    ];
	}
}
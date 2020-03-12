<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Log as Logs;

class LogMiddleware {

	public function handle(Request $request, Closure  $next)
	{
		$response = $next($request);
		
		// save log
		$model = new Logs();

		$model->method    	= $request->getMethod();
		$model->path		= $request->getPathInfo();
		$model->headers     = json_encode($request->header());
		$model->request     = json_encode($request->all());
		$model->response    = json_encode($response); 
		$model->save();
		// 
        
        return $response;
	}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function response($data,$status)
	{
		if(empty($data['message']))
		{
			$data['message'] = 'ok';	
		}	
		$data = array_merge(
			[
				"program" => APPLICATION_NAME,
				"release" => API_VERSION,
				"code" => $status,
				"message" => $data['message'],
			],
			$data
		);
		array_walk_recursive($data, function(&$item){if(is_numeric($item) || is_float($item)){$item=(string)$item;}});
		return \Response::json($data,200);
	}	
}

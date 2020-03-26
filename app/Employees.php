<?php

namespace App;

class Employees extends CommonModel
{
	protected $table = 'employees';
	protected $guarded = [];
	static $model = 'employees';

    static function details($id)
	{
		 $data = static::get($id);
		 
		 if($data)
		 {
		 	$company_data = Companies::get($data['company_id']);
		 	$data['company_name'] = $company_data['name'];
		 	
		 	// unset($data['password']);
		 	// $data['profile_image_url'] = image_url(AdminImageFolder,$data['profile_image']);
		 	return $data;
		 }
		 else
		 	return false;
	}
}

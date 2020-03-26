<?php

namespace App;

class Companies extends CommonModel
{
	protected $table = 'companies';
	protected $guarded = [];
	static $model = 'companies';

    static function details($id)
	{
		 $data = static::get($id);

		 if($data)
		 {
		 	// unset($data['password']);
		 	$data['company_logo_url'] = image_url(UrlImagesFolder,$data['logo']);
		 	return $data;
		 }
		 else
		 	return false;
	}
}

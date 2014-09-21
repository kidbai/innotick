<?php

namespace app\component;

use Yii;
use app\models\Admin;


class WebUser extends \yii\web\User  
{
  	const TYPE_STUDENT = 1;
  	const TYPE_TEACHER = 2;
  	const TYPE_ADMIN = 3;	

	protected function afterLogin( $identity, $cookieBased, $duration )
	{
		$time = time();
		$ip = app()->request->userIP;	
		$id = $this->getId();	

		if ($identity instanceof Admin) 
		{
			sql(" update {{%admin}} set last_login_time = $time where id = $id ")->query();
			// sql(" update {{admin}} set last_login_ip = '$ip' where id = $id ")->query();
		}
	}
}
?>
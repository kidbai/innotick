<?php

namespace app\controllers;

use Yii;
use app\component\BaseController;
use app\component\DXConst;
use app\component\UploadHandler;
use yii\helpers\Url;


class ResController extends BaseController
{
	public function actionImgUpload()
	{
		$upload_handler = new UploadHandler([
			'upload_dir' => './upload/img/',
			'param_name' => 'file',
			'upload_url' => Url::to(['/'], true) . 'upload/img/'
		]);
	}

	public function actionFileUpload()
	{
		$upload_handler = new UploadHandler([
			'upload_dir' => './upload/file/',
			'param_name' => 'file',
			'upload_url' => Url::to(['/'], true) . 'upload/file/'
		]);
	}	

	public function actionPdf($file = '')
	{
		$this->layout = false;

		return $this->render('/res/pdf', ['file' => $file]);
	}
}
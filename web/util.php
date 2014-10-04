<?php

function app() 
{
	return \Yii::$app;
}

function dump($target) 
{
	return yii\helpers\VarDumper::dump($target, 10, true);
}

function sql($sql = null) 
{
	$connection = \Yii::$app->db;
	$command = $connection->createCommand($sql);
	
	return $command;
}

function encodePass($rawPass)
{
	return md5(md5($rawPass));
}

function authPass($rawPass, $encodedPass)
{
	return encodePass($rawPass) === $encodedPass;
}

function makeToken()
{
	mt_srand((double) microtime() * 10000); 
	$key = md5(md5(uniqid(rand(), true)) . time());	
	
	return $key;
}

function param($name) 
{
	return \Yii::$app->params[$name];
}

function timeFormat($time, $format = 'full') 
{

	if ($time === '')
		return '';

	if ($format == 'ago') 
	{
		$unit = 60;
		$p = time() - $time;
		if ($p / $unit < 1) return ($p / 1) . '秒前';
		
		$unit*=60;
		if ($p / $unit < 1) return intval($p / 60) . '分钟前';
		
		$unit*=24;
		if ($p / $unit < 1) return intval($p / 60 / 60) . '小时前';
		
		$unit*=30;
		if ($p / $unit < 1) return intval($p / 60 / 60 / 24) . '天前';
		
		return tm($time, 'full');
	}
	if ($format == 'full')	return date('Y-m-d H:i:s', $time);
	if ($format == 'date')	return date('Y-m-d', $time);
	if ($format == 'month')	return date('m-d', $time);		
}

function imgUrlPrefix()
{
	return 'http://user.tongguanedu.com';
}

function admin()
{
	return app()->admin->identity;
}

function getConfig($key)
{
	return sql('select value from {{%config}} where `key` = :key ')->bindValues([':key' => $key])->queryScalar();
}

function setConfig($key, $value)
{
	$config = app\models\Config::find()->where(['key' => $key])->one();
	if (!$config)
	{
		$config = new app\models\Config();
		$config->key = $key;
	}
	
	$config->value = $value;



	return $config->save();
}

function url($params)
{
	return app()->urlManager->createUrl($params);
}

function getServerIp()
{
	exec("/sbin/ifconfig | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}'", $lines);

	return @$lines[0];
}

function getCategory()
{
	$db_category_list = sql(' select id, name from {{%post_category}} ')->queryAll();
	$category = [];
	foreach ($db_category_list as $db_category)
	{
		$id = intval($db_category['id']);
		$name = $db_category['name'];
		$category[$id] = $name;
	}
	return $category;
}	

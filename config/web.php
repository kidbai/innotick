<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => '/site/index',
    'components' => [
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => false,
            'cookieValidationKey' => 'hmsi6ma9',
        ],     
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                     'sourcePath' => null,
                     'js' => ['/js/jquery-1.11.1.min.js'],
                     'jsOptions' => ['position' => yii\web\View::POS_HEAD]
                ],
            ],
        ],     
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'admin' => [
            'class' => 'app\component\WebUser',
            'identityClass' => 'app\models\Admin',
            'identityCookie' => ['name' => '_identity_admin', 'httpOnly' => true],
            'idParam' => '__admin_id',
            'enableAutoLogin' => false,
        ],        
        'urlManager' => [
            'rules' => [
                '<controller:.+>/<id:\d+>' => '<controller>/view',
                // '<controller:.+>/<action:.+>/<id:\d+>' => '<controller>/<action>',
                // '<controller:.+>/<action:.+>' => '<controller>/<action>',
            ],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    // $config['bootstrap'][] = 'debug';
    // $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;

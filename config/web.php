<?php

use app\models\User;
use yii\caching\FileCache;
use yii\gii\Module;
use yii\helpers\ArrayHelper;
use yii\log\FileTarget;
use yii\symfonymailer\Mailer;

require_once __DIR__ . '/../app/bootstrap.php';

$config = [
    'id' => 'yii2-template-app',
    'basePath' => '@app',
    'vendorPath' => __DIR__ . '/../vendor',
    'runtimePath' => __DIR__ . '/../runtime',
    'timezone'=> 'Europe/Moscow',
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@runtime' => __DIR__ . '/../runtime',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '_hNYrCRHFUV2chOhoHDz0oscu6qK0N7_',
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
        'user' => [
            'identityClass' => User::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'baseUrl' => '',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => ArrayHelper::merge(
        require __DIR__ . '/params.php',
        file_exists(__DIR__ . '/params-local.php') ? require __DIR__ . '/params-local.php' : [],
    ),
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => Module::class,
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => Module::class,
    ];
}

return ArrayHelper::merge(
    $config,
    require __DIR__ . '/db.php',
    file_exists(__DIR__ . '/db-local.php') ? require __DIR__ . '/db-local.php' : [],
    file_exists(__DIR__ . '/web-local.php') ? require __DIR__ . '/web-local.php' : [],
);

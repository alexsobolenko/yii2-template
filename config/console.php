<?php

use yii\caching\FileCache;
use yii\gii\Module;
use yii\helpers\ArrayHelper;
use yii\log\FileTarget;

require_once __DIR__ . '/../app/bootstrap.php';

$config = [
    'id' => 'yii2-template-app-console',
    'basePath' => '@app',
    'vendorPath' => __DIR__ . '/../vendor',
    'runtimePath' => __DIR__ . '/../runtime',
    'bootstrap' => ['log'],
    'timezone'            => 'Europe/Moscow',
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
        '@runtime' => __DIR__ . '/../runtime',
        '@webroot' => __DIR__ . '/../web',
        '@root' => __DIR__ . '/..',
    ],
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
        'log' => [
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
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => Module::class,
    ];
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => Module::class,
    ];
}

return ArrayHelper::merge(
    $config,
    require __DIR__ . '/db.php',
    file_exists(__DIR__ . '/db-local.php') ? require __DIR__ . '/db-local.php' : [],
    file_exists(__DIR__ . '/console-local.php') ? require __DIR__ . '/console-local.php' : [],
);

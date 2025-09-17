<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=mysql;dbname=testDb',
            'username' => 'root',
            'password' => '1234',
            'charset' => 'utf8',
            'enableSchemaCache' => 604800,
            'tablePrefix' => 'tbl_',
            //'schemaCachingDuration' => 3600,
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
    ],
];

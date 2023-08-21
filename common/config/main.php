<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    // 'modules' => [
    //     'admin' => [
    //         'class' => 'mdm\admin\Module',
    //     ]
    // ],
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                   '@app/views' => '@vendor/hail812/yii2-adminlte3/src/views',
                ],
            ],
        ],
        'authManager' => [
            'class' => 'mdm\admin\components\DbManager', // Removed the extra comma (,) after the class definition
            'db' => 'db_rbac',

        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'class' => 'yii\web\User',
            // 'loginUrl' => ['site/login'],
        ],
        'urlManager' => [
            'rules' => [
                'create-predefined-user' => 'user/create-predefined-user',
                'profile' => 'userprofile/profile/view',
                'profile/update' => 'userprofile/profile/update',
                'settings' => 'userprofile/settings/view',
                'settings/update' => 'userprofile/settings/update',
            ],
        ],
        'defaultRoute' => 'site/login',
        'controllerNamespace' => 'backend\controllers',
    ],
];

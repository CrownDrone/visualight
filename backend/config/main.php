<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
                    'class' => 'mdm\admin\Module',
                  ],
        'chart' => [
                    'class' => 'app\modules\chart\Module',
                ],
       'userprofile' => [
                    'class' => 'common\modules\userprofile\Module',
                ],
        'nmd' => [
                    'class' => 'app\modules\nmd\Module',
                ],
        'predict' => [
                    'class' => 'app\modules\predict\Module',
                ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'view' => [
            'class' => 'yii\web\View',
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/example/vendor-package/views',
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
               'profile' => 'user-profile/view',
                'profile/update' => 'user-profile/update',
                'terms' => 'terms/terms/index',
                // 'survey/survey-form' => 'survey/default/survey-form',

            ],
        ],
        'authManager' => [
            'class' => 'mdm\admin\components\DbManager',
            'itemTable' => 'auth_item',
            'itemChildTable' => 'auth_item_child',
            'assignmentTable' => 'auth_assignment',
            'ruleTable' => 'auth_rule',
        ],
        
    ],
    'params' => $params,
];

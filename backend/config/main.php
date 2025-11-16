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
    'bootstrap' => ['log',],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'enableCookieValidation' => false,
            'enableCsrfValidation'   => false,
            'baseUrl'=>'/api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],

        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => backend\models\User::class,
            'loginUrl' => null,
            'enableAutoLogin' => true,
            'enableSession'=>false,
            'identityCookie'=>['name'=>'_identity-backend','httpOnly'=>true],
        ],
        'authenticator' => [
            'class' => \yii\filters\auth\HttpBearerAuth::class,
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
        'jwt' => [
            'class' => 'backend\components\JwtCom',
            'key' => 'sdfjlskdjgflkdsfhglkwejropkjsdlsdfsd2334213fds',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'POST auth'=>'site/login',
                'POST auth/pin'=>'site/login-pin',
                'POST auth/logout'=>'user/logout',
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET me'=>'me',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'camera',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET '=>'index',
                        'GET by-ip'=>'by-ip'
                    ],
                ],
            ],
        ]

    ],

    'params' => $params,
];
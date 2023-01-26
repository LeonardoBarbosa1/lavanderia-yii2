<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'SIS-LAV',
    'sourceLanguage'=>'pt-BR',
    'language'=>'pt-BR',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/login'],
            'authTimeout' => 1800, // auth expire in 30 minutes
            
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'qJpZnsb8NKCPDiyTsGhzeEfJGUcQY5bI',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
         'view' => [
            'class' => 'yii\web\View',
            'theme' => [
                'class' => 'yii\base\Theme',
                'pathMap' => [
                    '@app/views' => '@app/themes/lte'
                ],
            ],
         ],
         'assetManager' => [
        'bundles' => [
            'dmstr\web\AdminLteAsset' => [
                'skin' => 'skin-green',
            ],
        ],
    ],
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport'=>[
               'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => '',
                'password' => '',
                'port' => '587',
                'encryption' => 'tls',
            ],
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
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */ 'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                'sourceLanguage' => 'en',
                'fileMap' => [
                    //'main' => 'main.php',
                ],
            ],
        ],
    ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],
        ],
    ],
    'as beforeRequest' => [
    'class' => 'yii\filters\AccessControl',
    'rules' => [
        [
            'actions' => ['login', 'error','forgot','register','resend'],
            'allow' => true,
        ],
        [

                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'modules' => [
    'user' => [
        'class' => 'dektrium\user\Module',
        'enableUnconfirmedLogin' => false,
        'confirmWithin' => 21600,
        'cost' => 12,
        'admins' => ['admin','Leonardo'],
        'modelMap'=>[
            'RegistrationForm'=>'app\models\RegistrationForm'
        ]
    ],
        'rbac' =>  [
            'class' => 'yii2mod\rbac\Module',
        
    ],

    'sis' => [
        'class' => 'app\modules\sistema\Sistema',
    ],
    

    'gridview' => [
            'class' => 'kartik\grid\Module',
        ],
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute
            'displaySettings' => [
                'date' => 'd-m-Y',
                'time' => 'H:i:s A',
                'datetime' => 'd-m-Y H:i:s A',
            ],

            // format settings for saving each date attribute
            'saveSettings' => [
                'date' => 'Y-m-d', 
                'time' => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],



            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

        ]
],
    
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
       'generators' => [ //here
            'kartikgii-crud' => ['class' => 'warrence\kartikgii\crud\Generator'],
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'adminlte' => '@vendor/dmstr/yii2-adminlte-asset/gii/templates/crud/simple',
                    
                ]
             ]
        ]
    ];
    
}

return $config;

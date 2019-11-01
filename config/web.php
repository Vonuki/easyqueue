 <?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Easy Queue',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'sourceLanguage' => 'en',
    'language' => 'en',
  
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Pfxtnysq1',
            'parsers' => [
              'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
            
        'urlManager' => [
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,   // Chek should work for REST but make compliceted normal links ( for example HOME link)
            'showScriptName' => false,
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['ru', 'en'],
            'enableDefaultLanguageUrlCode' => true,
            'rules' => [
                'page/<view:[a-zA-Z0-9-]+>' => 'site/page',
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/owner', 'v1/queue'] ],
            ],
        ],
              
        'i18n' => [
            'translations' => [
                'lg_*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'robot@easymatic.su',
                'password' => 'Pfxtnysq1',
                'port' => '465',
                'encryption' => 'ssl',
            ],
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
      
    ],
    'params' => $params,
    
    'modules' => [
       'user' => [
          'class' => 'dektrium\user\Module',
          'admins' => ['admin'],
          'mailer' => [
                'sender'                => 'robot@easymatic.su',
                'welcomeSubject'        => 'Welcome to EasyQueue',
                'confirmationSubject'   => 'Confirmation completed',
                'reconfirmationSubject' => 'Email changed',
                'recoverySubject'       => 'Recovery request',
          ],
         
          //replacing or adding part of User functionality
           'modelMap' => [
                  'User' => 'app\models\UserDefault',

            ],
       ],

       'rbac' => 'dektrium\rbac\RbacWebModule',
  
        
      'v1' => [
        'basePath' => '@app/modules/api/v1',
        'class' => 'app\modules\api\v1\Module',
      ],
      
      'admin' => [
        'basePath' => '@app/modules/admin',
        'class' => 'app\modules\admin\Module',
        'on testEvent' => ['app\models\UserDefault', 'testHandler'],
      ],
      
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1','::1','*.*.*.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1','::1','*.*.*.*'],
    ];
}

return $config;

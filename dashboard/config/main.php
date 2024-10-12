<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-dashboard',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'dashboard\controllers',
    'bootstrap' => [
        'log',
        'queue'
    ],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-dashboard',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-dashboard', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the dashboard
            'name' => 'advanced-dashboard',
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
        'queue' => [
            'class' => \yii\queue\db\Queue::class,
            'db' => 'db', // Database connection component
            'tableName' => '{{%queue}}', // Table for the queue
            'channel' => 'default', // Queue channel
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex that used to sync queries
        ],
        'mutex' => [
            'class' => 'yii\mutex\FileMutex', // Or use 'yii\mutex\DbMutex' for database-based mutex
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

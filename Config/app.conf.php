<?php
return array(
    'debug' => true,

    // 服务配置
    'swooleServer' => [
        // 服务类型
        'type' => \Weekii\Core\Swoole\ServerManager::TYPE_HTTP,
        'port' => 9501,
        'host' => '0.0.0.0',
        'mode' => SWOOLE_PROCESS,
        'sockType' => SWOOLE_TCP,
        'setting' => [
            //'task_worker_num' => 8, //异步任务进程
            //'task_max_request' => 10,
            'max_request' => 5000,  // worker最大处理请求数
            'worker_num' => 8,      // worker数量
            'enable_coroutine' => true,     // 开启协程
        ]
    ],

    'database' => [
        'default' => [
            'driver'    => 'mysql',
            'host'      => '',
            'database'  => '',
            'username'  => '',
            'password'  => '',
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            //'unix_socket' => '/var/lib/mysql/mysql.sock',
            'prefix'    => 't_',
            'port'      => 3306,
            'getConnectionTimeout' => 1,    // 获取连接最多等待秒数
            'poolSize' => 50,
            'debug' => true                 // 调试模式，打印sql
        ]
    ],

    // 是否开启路由缓存
    'routeCache' => true,
    // 路由缓存内存表大小
    'routeTableSize' => 1024,
    // 路由缓存表名称 (Container 中的 key)
    'routeTableName' => '__routeTable',

    // 临时文件夹
    'tempDir' => PROJECT_ROOT . '/temp',

    'timezone' => 'Asia/Shanghai',

    'providers' => [
        /** Framework Service Providers **/
        \Weekii\Core\Http\HttpServiceProvider::class,
        \Weekii\Lib\Database\DatabaseServiceProvider::class,
        \Weekii\Lib\Pool\PoolServiceProvider::class
    ],
);
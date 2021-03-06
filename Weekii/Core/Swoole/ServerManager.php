<?php
namespace Weekii\Core\Swoole;

use Weekii\Core\App;
use Weekii\Core\BaseInterface\Singleton;
use Weekii\Core\Constant;
use Weekii\Lib\Config;

class ServerManager
{
    use Singleton;

    const TYPE_NORMAL = 1;
    const TYPE_HTTP = 2;
    const TYPE_WEB_SOCKET = 3;
    const TYPE_TCP = 4;

    private $server = null;
    private $isStart = false;

    public function start()
    {
        $this->createServer();
        $this->server->start();
    }

    public function getServer()
    {
        if ($this->isStart) {
            return $this->server;
        } else {
            return null;
        }
    }

    private function createServer()
    {
        $conf = Config::getInstance()->get('app')['swooleServer'];
        $app = App::getInstance();

        switch ($conf['type']) {
            case self::TYPE_NORMAL:
                $this->server = new \swoole_server($conf['host'], $conf['port'], $conf['mode'], $conf['sockType']);
                break;
            case self::TYPE_HTTP:
                $this->server = $app->make(Constant::HTTP_SERVER);
                break;
            case self::TYPE_WEB_SOCKET:
                $this->server = new \swoole_websocket_server($conf['host'], $conf['port'], $conf['mode'], $conf['sockType']);
                break;
            default:
                throw new \Exception('Unknown server type : ' . $conf['type']);
        }



        return $this->server;
    }



    private function beforeServerStart(EventRegister $register)
    {

    }
}
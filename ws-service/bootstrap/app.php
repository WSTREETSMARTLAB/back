<?php

use App\WebSocket\Handler;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Loop;
use React\Socket\SocketServer;

$loop = Loop::get();
$server = new SocketServer('0.0.0.0:8081', $loop);

$handler = new Handler();

$webSocketServer = new IoServer(
    new HttpServer(new WsServer($handler)),
    $server,
    $loop
);

$redis = new Redis();
$redis->connect('w5smtlab-redis', 6379);

$subscriber = new \App\WebSocket\Subscriber($redis, $handler);
$loop->addTimer(1, function () use ($subscriber) {
    return $subscriber->listen();
});

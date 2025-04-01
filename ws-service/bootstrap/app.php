<?php

use App\WebSocket\Handler;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Loop;
use React\Socket\SocketServer;

$loop = Loop::get();
$server = new SocketServer('0.0.0.0:8081', [], $loop);

$handler = new Handler();

$webSocketServer = new IoServer(
    new HttpServer(new WsServer($handler)),
    $server,
    $loop
);

$redisFactory = new \Clue\React\Redis\Factory($loop);

$redisFactory->createClient('redis://w5smtlab-redis:6379')->then(function ($client) use ($handler) {
    $client->psubscribe('sensor:*:signal');

    $client->on('pmessage', function ($pattern, $channel, $message) use ($handler) {
        $handler->broadcast($channel, $message);
    });
});

return $webSocketServer;

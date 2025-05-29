<?php

namespace App\WebSocket;


class Subscriber
{
    public function __construct(private \Redis $redis, private Handler $handler)
    {
    }

    public function listen()
    {
        $this->redis->psubscribe(['sensor:*:signal'],
            function ($redis, $pattern, $channel, $message) {
                $this->handler->broadcast($channel, $message);
            });
    }
}

<?php

namespace App\WebSocket;

use Ratchet\MessageComponentInterface;

class Handler implements MessageComponentInterface
{
    protected \SplObjectStorage $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen($conn)
    {
        $this->clients->attach($conn);
    }

    public function onMessage($from, $msg)
    {
        /* Получили сообщение */
    }

    public function onClose($conn)
    {
        $this->clients->detach($conn);
    }

    public function onError($conn, $e)
    {
        /* Ошибка */
    }

    public function broadcast(string $channel, string $message): void
    {
        foreach ($this->clients as $client) {
            $client->send($message);
        }
    }
}

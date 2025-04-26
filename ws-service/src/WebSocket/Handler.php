<?php

namespace App\WebSocket;

use Ratchet\MessageComponentInterface;

class Handler implements MessageComponentInterface
{
    protected \SplObjectStorage $clients;
    protected array $channels = [];

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
        $data = json_decode($msg, true);

        if (isset($data['action']) && $data['action'] === 'subscribe') {
            if (!isset($data['channel'])) {
                return;
            }

            $channel = $data['channel'];
            $this->subscribe($from, $channel);
            return;
        }
    }

    public function onClose($conn)
    {
        $this->clients->detach($conn);

        foreach ($this->channels as $channel => $clients) {
            foreach ($clients as $client) {
                if ($client === $conn) {
                    $this->channels[$channel]->detach($conn);
                }
            }
            unset($client);
        }
    }

    public function onError($conn, $e)
    {
        /* Ошибка */
    }

    public function broadcast(string $channel, string $message): void
    {
        if (!isset($this->channels[$channel])) {
            return;
        }

        foreach ($this->channels[$channel] as $client) {
            $client->send($message);
        }
    }

    public function subscribe($conn, $channel): void
    {
        if (!isset($this->channels[$channel])) {
            $this->channels[$channel] = new \SplObjectStorage();
        }

        $this->channels[$channel]->attach($conn);
    }
}

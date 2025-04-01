<?php

namespace App\WebSocket;

use Ratchet\MessageComponentInterface;

class Handler implements MessageComponentInterface
{
    public function onOpen($conn)
    {
        /* Подключился */
    }

    public function onMessage($from, $msg)
    {
        /* Получили сообщение */
    }

    public function onClose($conn)
    {
        /* Отключился */
    }

    public function onError($conn, $e)
    {
        /* Ошибка */
    }
}

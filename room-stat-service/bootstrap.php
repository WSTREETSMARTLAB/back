<?php

use Dotenv\Dotenv;

$envPath = dirname(__DIR__) . '/../back';
$dotenv = Dotenv::createImmutable($envPath);
$dotenv->load();

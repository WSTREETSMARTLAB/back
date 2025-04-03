<?php

return [
    'driver' => 'redis',
    'redis' => [
        'host' => getenv('REDIS_HOST', 'w5smtlab-redis'),
        'port' => getenv('REDIS_PORT', 6379),
        'password' => getenv('REDIS_PASSWORD', ''),
        'db' => getenv('REDIS_DB', 0),
    ],
];

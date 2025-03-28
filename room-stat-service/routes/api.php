<?php

$res = json_encode([
    'message' => 'OK',
]);

return [
    ['GET', '/api/v1/health-check', $res],
];

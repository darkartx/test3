<?php

return [
    'app' => [
        'root' => getenv('APP_ROOT') ?: '',
    ],
    'database' => [
        'host' => getenv('DATABASE_HOST') ?: 'localhost',
        'port' => getenv('DATABASE_PORT') ?: 3306,
        'name' => getenv('DATABASE_NAME') ?: 'test',
        'username' => getenv('DATABASE_USERNAME') ?: null,
        'password' => getenv('DATABASE_PASSWORD') ?: null
    ]
];

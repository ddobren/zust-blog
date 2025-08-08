<?php

return [
    "db" => [
        "host" => "db",
        "username" => "zust",
        "password" => "zust123",
        "database" => "zust",
        "port" => "3306",
    ],

    "app" => [
        "name" => "MyBlog",
        "env" => "development"
    ],
    "adminUser" => [
        "username" => "admin",
        "password" => "adminko123"
    ],
    "session" => [
        "lifetime" => 86400, // 1 dan
        "path" => "/",
        "domain" => "", // npr. "example.com"
        "secure" => false, // true ako se koristi HTTPS
        "httponly" => true,
        "samesite" => "Lax"
    ]
];

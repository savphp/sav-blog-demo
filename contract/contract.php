<?php

return [
  "modals" => [
    "Home" => [
      "routes" => [
        ["name" => "index", "path" => "/", "method" => "GET", "view" => true],
    ]],
    "Account" => [
      "routes" => [
        ["name" => "login", "method" => "GET", "view" => true, "title" => "登录页面"],
        ["name" => "register", "method" => "GET", "view" => true, "title" => "注册页面"],
    ]],
  ],
];

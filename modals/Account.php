<?php

class Account {
  public function login($ctx)
  {
    $viewCount = $ctx->redis->hget("views", $ctx->route["path"]);
    require_once(__DIR__ . "/../views/login.php");
  }
  public function register($ctx)
  {
    $viewCount = $ctx->redis->hget("views", $ctx->route["path"]);
    require_once(__DIR__ . "/../views/register.php");
  }
}

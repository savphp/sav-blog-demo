<?php

class Account {
  public function login($ctx)
  {
    return $ctx->view("login", ["title" => "登录..."]);
  }
  public function register($ctx)
  {
    return $ctx->view("register");
  }
}

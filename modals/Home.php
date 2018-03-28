<?php

class Home {

  public function index ($ctx) {
    $viewCount = $ctx->redis->hget("views", $ctx->route["path"]);
    $view = $ctx->view;
    return $view("index", ["viewCount" => $viewCount]);
  }

}

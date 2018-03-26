<?php

class Home {

  public function index ($ctx) {
    $viewCount = $ctx->redis->hget("views", $ctx->route["path"]);
    // $users = $ctx->db::table("users")->get();
    $users = $ctx->db::select("select * from users");
    var_dump($users);
    require_once(__DIR__ . "/../views/index.php");
  }

}

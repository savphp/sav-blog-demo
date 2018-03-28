<?php

include_once(__DIR__ .'/../vendor/autoload.php');

use Sav\Sav;
use Predis\Client;
use Illuminate\Database\Capsule\Manager as Capsule;
// blade
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\ViewServiceProvider;

$sav = new Sav([
  "modalPath" => __DIR__ . "/../modals/",
  "contractFile" => __DIR__ . "/../contract/contract.php"
]);

$sav->register('conf', function ($ctx) {
  return include_once(__DIR__ . "/../config.php");
});

$sav->register('redis', function ($ctx) {
  $redis = new Predis\Client($ctx->conf["redis"]);
  if ($ctx->route) { // 页面访问次数统计
    $path = $ctx->route["path"];
    $redis->hincrby('views', $path, 1);
  }
  return $redis;
});

$sav->register('db', function ($ctx) {
  $db = new Capsule();
  $db->setFetchMode(\PDO::FETCH_ASSOC);
  $db->addConnection($ctx->conf["db"]);
  $db->setAsGlobal();
  return $db;
});

$sav->register('blade', function ($ctx) {
  $container = new Container();
  $container->bindIf('files', function () {
      return new Filesystem;
  }, true);
  $container->bindIf('events', function () {
      return new Dispatcher;
  }, true);
  $container->bindIf('config', function () use ($ctx){
      return $ctx->conf["blade"];
  }, true);
  (new ViewServiceProvider($container))->register();
  return $container['view'];
});

$sav->register('view', function ($ctx) {
  return function ($view, $data = [], $mergeData = []) use($ctx) {
    return $ctx->blade->make($view, $data, $mergeData)->render();
  };
});

$sav->execute();

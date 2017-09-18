<?php
$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
  $settings = $c->get('settings')['renderer'];
  return new Slim\Views\PhpRenderer($settings['template_path']);
};

// firebase conection
$container['firebase'] = function ($c) {
    $settings = $c->get('settings')['firebase'];
    $firebase = new \Firebase\FirebaseLib($settings['DEFAULT_URL'], $settings['DEFAULT_TOKEN']);
    return $firebase;
};

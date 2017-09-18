<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

function pr($t){
  print '<pre>';
  print_r($t);
  print '</pre>';
}

pr($_SESSION);

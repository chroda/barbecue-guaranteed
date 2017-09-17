<?php
// Routes

$app->get('/', function ($request, $response, $args) {
  return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/dashboard', function ($request, $response, $args) {
  return $this->renderer->render($response, 'dashboard.phtml', $args);
});

$app->get('/register-company', function ($request, $response, $args) {
  return $this->renderer->render($response, 'register-company.phtml', $args);
});

$app->get('/new-request', function ($request, $response, $args) {
  return $this->renderer->render($response, 'new-request.phtml', $args);
});

$app->get('/my-account', function ($request, $response, $args) {
  return $this->renderer->render($response, 'my-account.phtml', $args);
});

$app->get('/logout', function ($request, $response, $args) {
  return $this->renderer->render($response, 'logout.phtml', $args);
});

$app->get('/login', function ($request, $response, $args) {
  return $this->renderer->render($response, 'login.phtml', $args);
});

$app->get('/new-account', function ($request, $response, $args) {
  return $this->renderer->render($response, 'new-account.phtml', $args);
});

// $app->get('/[{name}]', function ($request, $response, $args) {
//   return $this->renderer->render($response, 'index.phtml', $args);
// });

<?php
// Routes

$app->get('/', function ($request, $response, $args) {
  // if logged, go to dashboard, otherwise go to login
  return $response->withStatus(200)->withHeader('Location', 'login');
});


$app->get('/login', function ($request, $response, $args) {
  return $this->renderer->render($response, 'login.phtml', $args);
});
$app->post('/login', function ($request, $response, $args) {
  echo 'post login';
  // return $this->renderer->render($response, 'login.phtml', $args);
});

$app->get('/new-account', function ($request, $response, $args) {
  return $this->renderer->render($response, 'new-account.phtml', $args);
});
$app->post('/new-account', function ($request, $response, $args) {
  echo 'post new-account';
  // return $this->renderer->render($response, 'login.phtml', $args);
});


$app->get('/dashboard', function ($request, $response, $args) {
  return $this->renderer->render($response, 'dashboard.phtml', $args);
});

$app->get('/register-company', function ($request, $response, $args) {
  return $this->renderer->render($response, 'register-company.phtml', $args);
});
$app->post('/register-company', function ($request, $response, $args) {
  echo 'post register-company';
  // return $this->renderer->render($response, 'login.phtml', $args);
});

$app->get('/new-order', function ($request, $response, $args) {
  return $this->renderer->render($response, 'new-order.phtml', $args);
});
$app->post('/new-order', function ($request, $response, $args) {
  echo 'post new-order';
  // return $this->renderer->render($response, 'login.phtml', $args);
});

$app->get('/my-account', function ($request, $response, $args) {
  return $this->renderer->render($response, 'my-account.phtml', $args);
});

$app->get('/logout', function ($request, $response, $args) {
  // unlogged current user
  return $response->withStatus(200)->withHeader('Location', 'login');
});


// $app->get('/[{name}]', function ($request, $response, $args) {
//   return $this->renderer->render($response, 'index.phtml', $args);
// });

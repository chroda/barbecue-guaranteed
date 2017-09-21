<?php
// Routes

$app->get('/', function ($request, $response, $args) {
  // if logged, go to dashboard, otherwise go to login
  return $response->withStatus(200)->withHeader('Location',empty($_SESSION['user']) ? 'login' : 'dashboard');
});

$app->get('/login', function ($request, $response, $args) {
  if (!empty($_SESSION['user'])) {
    return $response->withStatus(200)->withHeader('Location', 'dashboard');
  }
  return $this->renderer->render($response, 'login.phtml', $args);
});
$app->post('/login', function ($request, $response, $args) {
  if (!empty($_POST)) {
    $key_mail = str_replace('.','_',$_POST['email']);
    $has_key_mail = $this->firebase->get('/users/'.$key_mail);
    if($has_key_mail != 'null') {
      $key_auth = json_decode($has_key_mail);
      if(md5($_POST['password']) == $key_auth->password){
        $_SESSION['user'] = $key_auth->email;
        return $response->withStatus(200)->withHeader('Location', 'dashboard');
      }
    }
  }
  return $response->withStatus(200)->withHeader('Location', 'login');
});

$app->get('/new-account', function ($request, $response, $args) {
  if (!empty($_SESSION['user'])) {
    return $response->withStatus(200)->withHeader('Location', 'dashboard');
  }
  return $this->renderer->render($response, 'new-account.phtml', $args);
});
$app->post('/new-account', function ($request, $response, $args) {
  if (!empty($_POST)) {
    if ( $_POST['password'] != $_POST['repeat-password'] ) {
      return $response->withStatus(200)->withHeader('Location', 'new-account');
    }
    $key_mail = str_replace('.','_',$_POST['email']);
    $has_key_mail = $this->firebase->get('/users/'.$key_mail);
    if($has_key_mail == 'null') {
      $this->firebase->set( '/users/'.$key_mail,[
        'email' => $_POST['email'],
        'password' => md5($_POST['password'])
      ]);
      return $response->withStatus(200)->withHeader('Location', 'dashboard');
    } else {
      return $response->withStatus(200)->withHeader('Location', 'new-account');
    }
  }
  return $response->withStatus(200)->withHeader('Location', 'new-account');
});

$app->get('/dashboard', function ($request, $response, $args) {
  if (empty($_SESSION['user'])) {
    return $response->withStatus(200)->withHeader('Location', 'login');
  }
  return $this->renderer->render($response, 'dashboard.phtml', $args);
});

$app->get('/register-company', function ($request, $response, $args) {
  if (empty($_SESSION['user'])) {
    return $response->withStatus(200)->withHeader('Location', 'login');
  }
  return $this->renderer->render($response, 'register-company.phtml', $args);
});
$app->post('/register-company', function ($request, $response, $args) {
  if (empty($_SESSION['user'])) {
    return $response->withStatus(200)->withHeader('Location', 'login');
  }
  if (is_cnpj($_POST['cnpj'])) {
    $cnpj = preg_replace('/[^0-9]/', '', (string) $_POST['cnpj']);
    $this->firebase->set( '/companies/'.$cnpj,[
      'cnpj' => $cnpj,
      'name' =>$_POST['name']
    ]);
  }
  return $response->withStatus(200)->withHeader('Location', 'dashboard');
});

$app->get('/new-order', function ($request, $response, $args) {
  if (empty($_SESSION['user'])) {
    return $response->withStatus(200)->withHeader('Location', 'login');
  }
  $companies = (array) json_decode($this->firebase->get('/companies'));
  return $this->renderer->render($response, 'new-order.phtml', ['companies'=>$companies]);
});
$app->post('/new-order', function ($request, $response, $args) {
  if (empty($_SESSION['user'])) {
    return $response->withStatus(200)->withHeader('Location', 'login');
  }

});

$app->get('/my-account', function ($request, $response, $args) {
  if (empty($_SESSION['user'])) {
    return $response->withStatus(200)->withHeader('Location', 'login');
  }
  return $this->renderer->render($response, 'my-account.phtml', $args);
});
$app->post('/my-account', function ($request, $response, $args) {
  if (empty($_SESSION['user'])) {
    return $response->withStatus(200)->withHeader('Location', 'login');
  }
  $key_mail = str_replace('.','_',$_POST['email']);
  if ($_POST['email'] == $_SESSION['user']){
    $this->firebase->update( '/users/'.$key_mail,[
      'password' => md5($_POST['password'])
    ]);
  } else {
    $has_key_mail = $this->firebase->get('/users/'.$key_mail);
    if($has_key_mail == 'null') {
      $this->firebase->set( '/users/'.$key_mail,[
        'email' => $_POST['email'],
        'password' => md5($_POST['password'])
      ]);
      $this->firebase->delete( '/users/'.str_replace('.','_',$_SESSION['user']));
      $_SESSION['user'] = $_POST['email'];
    }
  }
  return $response->withStatus(200)->withHeader('Location', 'dashboard');
});

$app->get('/logout', function ($request, $response, $args) {
  unset($_SESSION['user']);
  return $response->withStatus(200)->withHeader('Location', 'login');
});


// $app->get('/[{name}]', function ($request, $response, $args) {
//   return $this->renderer->render($response, 'index.phtml', $args);
// });

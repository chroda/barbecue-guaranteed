<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});

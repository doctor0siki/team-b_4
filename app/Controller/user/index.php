<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Userページのコントローラ
$app->get('/', function (Request $request, Response $response) {

  $data = [];

  // Render index view
  return $this->view->render($response, 'user/index.twig', $data);
});

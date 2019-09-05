<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Searchページのコントローラ
$app->get('/search/', function (Request $request, Response $response) {

  $data = [];

  // Render index view
  return $this->view->render($response, 'search/index.twig', $data);
});

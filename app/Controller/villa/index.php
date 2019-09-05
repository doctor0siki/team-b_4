<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Villaページのコントローラ
$app->get('/villa/', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'villa/index.twig', $data);
});

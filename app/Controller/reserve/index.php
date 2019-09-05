<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Reserveページのコントローラ
$app->get('/villa/reserve/', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'reserve/index.twig', $data);
});

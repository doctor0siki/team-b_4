<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Reserveページのコントローラ
$app->get('/villa/reserve/{ villa_id }[/]', function (Request $request, Response $response, $args) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'reserve/index.twig', $data);
});

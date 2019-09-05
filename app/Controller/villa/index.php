<?php

use Model\Dao\Villa;
use Slim\Http\Request;
use Slim\Http\Response;

// Villaページのコントローラ
$app->get('/villa/{ villa_id }[/]', function (Request $request, Response $response, $args) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'villa/index.twig', $data);
});

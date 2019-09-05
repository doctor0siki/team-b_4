<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Historyページのコントローラ
$app->get('/history/', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'history/index.twig', $data);
});

<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Reserveページのコントローラ
// 予約画面
$app->get('/reserve/{ villa_id:[0-9+] }[/]', function (Request $request, Response $response, $args) {

    $data = [
        villa_id => $args["villa_id"]
    ];
    // $data = [];
    // dd($data);
    // Render index view
    return $this->view->render($response, 'reserve/index.twig', $data);
});

// 予約確認画面
$app->get('/reserve/confirm/{ villa_id }[/]', function (Request $request, Response $response, $args) {

    //GETされた内容を取得します。
    // $data = $request->getQueryParams();
    $data = [];


    // Render index view
    return $this->view->render($response, 'reserve/check.twig', $data);
});

// 予約完了画面
$app->post('/reserve/confirmed[/]', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    // dd($data);
    // $data = [];
    // Render index view
    return $this->view->render($response, 'reserve/confirmed.twig', $data);
});

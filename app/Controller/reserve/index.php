<?php

use Model\Dao\Villa;

use Slim\Http\Request;
use Slim\Http\Response;

// Reserveページのコントローラ
// 予約画面
$app->get('/reserve/{ villa_id:[0-9]+}[/]', function (Request $request, Response $response, $args) {

    $villa = new Villa($this->db);

    $data["villa"] = $villa->getVilla($args["villa_id"]);
//	dd($data);
    // $data = [];
    // dd($data);
    // Render index view
    return $this->view->render($response, 'reserve/index.twig', $data);


    // return $response->withRedirect('reserve/check.twig')
});

// 予約確認画面
$app->get('/reserve/confirm/{ villa_id }[/]', function (Request $request, Response $response, $args) {

    $villa = new Villa($this->db);

    $data = [
        reserve => $data = $request->getQueryParams(),
        villa   => $villa->getVilla($args["villa_id"])
    ];
    //GETされた内容を取得します。

    // dd($data);


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

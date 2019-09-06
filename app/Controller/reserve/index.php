<?php

use Model\Dao\Villa;
use Model\Dao\Reserve;
use Slim\Http\Request;
use Slim\Http\Response;

// Reserveページのコントローラ
// 予約画面
$app->get('/reserve/{ villa_id:[0-9]+}[/]', function (Request $request, Response $response, $args) {

    $villa = new Villa($this->db);

    $data["villa"] = $villa->getVilla($args["villa_id"]);

    return $this->view->render($response, 'reserve/index.twig', $data);

});

// 予約確認画面
$app->get('/reserve/confirm/{ villa_id }[/]', function (Request $request, Response $response, $args) {

    $villa = new Villa($this->db);

    $data = [
        "reserve" => $data = $request->getQueryParams(),
        "villa"   => $villa->getVilla($args["villa_id"])
    ];

    // Render index view
    return $this->view->render($response, 'reserve/check.twig', $data);
});

// 予約完了画面

$app->post('/reserve/confirmed[/]', function (Request $request, Response $response) {

    $data = $request->getParsedBody();
    $reserve = new Reserve($this->db);

    $res = $request->getParsedBody();
    $data = [
        "villa_id" => $res["villa_id"],
        "user_id" => $res["user_id"],
        "date" => $res["date"]
    ];

    $id = $reserve->insert($data);

    // Render index view
    return $this->view->render($response, 'reserve/confirmed.twig', $data);
});

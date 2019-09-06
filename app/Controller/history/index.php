<?php

use Model\Dao\Reserve;
use Slim\Http\Request;
use Slim\Http\Response;

// Historyページのコントローラ
$app->get('/history/', function (Request $request, Response $response) {

    // Reserve DAOをインスタンス化
    $reserve = new Reserve($this->db);

    // 各データを格納
    $data = [
        "past_reserve" => $reserve->getPastReserveByUser($this->session["user_info"]["id"]),
        "future_reserve" => $reserve->getFutureReserveByUser($this->session["user_info"]["id"])
    ];

    dd($data);

    // Render index view
    return $this->view->render($response, 'history/index.twig', $data);
});

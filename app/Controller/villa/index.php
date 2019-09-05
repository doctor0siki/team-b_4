<?php

use Model\Dao\Villa;
use Slim\Http\Request;
use Slim\Http\Response;

// Villaページのコントローラ
$app->get('/villa/{ villa_id }[/]', function (Request $request, Response $response, $args) {

    $data = [];

    // VillaのDAOをインスタンス化
    $villa = new Villa($this->db);

    // 一覧を取得し、戻り値をresultに格納します
    $data = [
        'villas' => $villa->getVillaList
    ];

    // Render index view
    return $this->view->render($response, 'villa/index.twig', $data);
});

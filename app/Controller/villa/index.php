<?php

use Model\Dao\Villa;
use Model\Dao\Spot;
use Slim\Http\Request;
use Slim\Http\Response;

// Villaページのコントローラ
$app->get('/villa/{ villa_id }[/]', function (Request $request, Response $response, $args) {

    // Villa DAOをインスタンス化
    $villa = new Villa($this->db);

    // Villaを取得し、戻り値をresultに格納します
    $data = [
        "villa" => $villa->getVilla($args["villa_id"]),
        "spots" => $villa->getSpotByVilla(($args["villa_id"]))
    ];

    dd($data);

    // Render index view
    return $this->view->render($response, 'villa/index.twig', $data);
});

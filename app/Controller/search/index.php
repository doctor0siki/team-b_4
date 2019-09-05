<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Villa;

// Searchページのコントローラ
$app->get('/search/', function (Request $request, Response $response) {

    $data = [];

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    //別荘を検索するのでVillaDaoをインスタンス化
    $villa = new Villa($this->db);

    //キーワード検索実施
    $data["result"] = $villa->searchByKeyword($data["keyword"]);

    // Render index view
    return $this->view->render($response, 'search/index.twig', $data);
});

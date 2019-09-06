<?php

use Model\Dao\Topic;
use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    // DAO, topic DAOをインスタンス化
    $topic = new Topic($this->db);

    $data = [
        "topics" => $topic->getTopicList()
    ];

    //デスクリプションの文字列を200字でカット。
    foreach ($data["topics"] as $key => $val) {
        $data["topics"][$key]["description"] = mb_strimwidth($val["description"], 0, 220, "...");
    }

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});

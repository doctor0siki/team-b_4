<?php

use Model\Dao\User;
use Model\Dao\Topic;
use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    // User DAO, topic DAOをインスタンス化
    $user = new User($this->db);
    $topic = new Topic($this->db);

    // セッションに登録されたユーザIDを取得
    $user_id = $this->session["user_info"]["id"];

    $data = [];
    if ($user_id) {
        $data["user"] = $user->getUser($user_id);
        $data["topics"] = $topic->getTopicList($user_id);
    }

    dd($data);

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});

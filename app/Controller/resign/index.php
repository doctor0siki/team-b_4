<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;


// 会員登録ページコントローラ
$app->get('/resign/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'resign/resign.twig', $data);

});

// 会員登録処理コントローラ
$app->post('/resign/', function (Request $request, Response $response) {

    //POSTされた内容を取得します
    $data = $request->getParsedBody();

    //ユーザーDAOをインスタンス化
    $user = new User($this->db);

    //ログイン中のユーザーを削除する
    $user->delete($this->session->user_info["id"]);

    //セッションから情報削除
    $this->session::destroy();

    // 登録完了ページを表示します。
    return $this->view->render($response, 'resign/resign_done.twig', $data);

});

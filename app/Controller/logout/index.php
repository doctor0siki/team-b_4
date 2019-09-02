<?php

use Slim\Http\Request;
use Slim\Http\Response;

// ログアウトコントローラ
$app->get('/logout/', function (Request $request, Response $response) {

    // Destroy session
    $this->session::destroy();

    //TOPへリダイレクト
    return $response->withRedirect('/');

});

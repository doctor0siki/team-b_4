<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Calendar;

$app->get('/cal', function (Request $request, Response $response) {


    //カレンダーを使う場合は以下の様に対応してください。
    //引数は取りたい年月です。
    $data = Calendar::getCalArray("201904");

    return $this->view->render($response, 'cal/index.twig', $data);
});

<?php

use Model\Dao\Item;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * 商品一覧を出すコントローラです
 *
 * detail/1 = 1番の商品を
 * detail/13 = 13番の商品を
 * 表示する仕組みになっています。
 *
 * {item_id}の中身は$argsに入ります。
 * 取得する時は、$args["item_id"]で取得できます。
 */
$app->get('/item/detail/{item_id}', function (Request $request, Response $response, $args) {


    $data = [];

    //URLパラメータのitem_idを取得します。
    $item_id = $args["item_id"];

    //アイテムDAOをインスタンス化します。
    $item = new Item($this->db);

    //URLパラメータのitem_id部分を引数として渡し、戻り値をresultに格納します
    $data["result"] = $item->getItem($item_id);

    // Render index view
    return $this->view->render($response, 'item/detail.twig', $data);

});

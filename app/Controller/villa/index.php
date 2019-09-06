<?php

use Model\Dao\Villa;
use Model\Dao\Reserve;
use Model\Calendar;

use Slim\Http\Request;
use Slim\Http\Response;

// Villaページのコントローラ
$app->get('/villa/{ villa_id }[/]', function (Request $request, Response $response, $args) {

    // Villa DAO & Reserve DAOをインスタンス化
    $villa = new Villa($this->db);
    $reserve = new Reserve($this->db);

    $cal = Calendar::getCalArray(date("Ym"));
    $reserves = $reserve->getReserveByVilla($args["villa_id"], date("Y-m-d"));
    $reserved_list = Reserve::formatReserveList($reserves);

    for ($i = 0; $i < count($cal) - 1; $i++) {
        if (!$cal[$i]["day"])
            $cal[$i]["reserved"] = false;
        else if (in_array($cal[$i]["day"], $reserved_list))
            $cal[$i]["reserved"] = false;
        else
            $cal[$i]["reserved"] = true;
    }

    // 各データを格納
    $data = [
        "villa" => $villa->getVilla($args["villa_id"]),
        "spots" => $villa->getSpotByVilla(($args["villa_id"])),
        "calendar" => $cal,
        "today" => (int) date("j")
    ];

    // Render index view
    return $this->view->render($response, 'villa/index.twig', $data);
});

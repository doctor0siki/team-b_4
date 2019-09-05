<?php

namespace Model\Dao;

use Doctrine\DBAL\DBALException;
use PDO;

/**
 * Class Villa
 *
 * Villaテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @author wkmkymt <wkmkymt@gmail.com>
 * @since 2019/09/05
 * @package Model\Dao
 */
class Villa extends Dao
{

    /**
     * getVilla Function
     *
     * Villaテーブルから指定idのレコードを一件取得するクエリです。
     *
     * @param int $villa_id 引数として、取得したい商品のアイテムIDを指定します。
     * @return array $result 結果情報を連想配列で指定します。
     * @throws DBALException
     * @author wkmkymt <wkmkymt@gmail.com>
     * @since 2019/09/05
     */
    public function getVilla($villa_id)
    {

        // idを指定して取得するクエリを作成
        $sql = "select * from villa where id = :id";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        // idを指定します
        $statement->bindParam(":id", $villa_id, PDO::PARAM_INT);

        // SQLを実行
        $statement->execute();

        // 結果レコードを一件取得し、返送
        return $statement->fetch();
    }

    public function getSpotByVilla($villa_id)
    {

        // Villa_idを指定して取得するクエリを作成
        $sql = "select spot.*
                    from spot_villa 
                        left join spot on spot_villa.spot_id = spot.id
                    where spot_villa.villa_id = :id";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        // idを指定します
        $statement->bindParam(":id", $villa_id, PDO::PARAM_INT);

        // SQLを実行
        $statement->execute();

        // 結果レコードを一件取得し、返送
        return $statement->fetchAll();
    }
}

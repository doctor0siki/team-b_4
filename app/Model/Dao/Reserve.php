<?php

namespace Model\Dao;

use Doctrine\DBAL\DBALException;
use PDO;

/**
 * Class Reserve
 *
 * Reserveテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @author wkmkymt <wkmkymt@gmail.com>
 * @since 2019/09/05
 * @package Model\Dao
 */
class Reserve extends Dao
{

    /**
     * getReserveByVilla Function
     *
     * Reserveテーブルから指定villa_idのレコードを全件取得するクエリです。
     *
     * @param int $villa_id 引数として、取得したい予約記録を指定します。
     * @return array $result 結果情報を連想配列を返します。
     * @throws DBALException
     * @author wkmkymt <wkmkymt@gmail.com>
     * @since 2019/09/05
     */
    public function getReserveByVilla($villa_id, $reserve_date)
    {

        // Villa_idを指定して取得するクエリを作成
        $sql = "select *
                    from reserve
                    where date_format(date, '%Y-%m') = date_format(:date, '%Y-%m') and villa_id = :id";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        // villa_idを指定します
        $statement->bindValue(":id", $villa_id, PDO::PARAM_INT);

        // reserve_dateを指定します
        $statement->bindValue(":date", $reserve_date, PDO::PARAM_STR);

        // SQLを実行
        $statement->execute();

        // 結果レコードを一件取得し、返送
        return $statement->fetchAll();
    }

    /**
     * formatReserveList Function
     *
     * Reserveテーブルから指定villa_idのレコードを全件取得するクエリです。
     *
     * @param array $reserves 引数として、予約記録を指定します。
     * @return array $result フォーマットし直した連想配列を返します。
     * @author wkmkymt <wkmkymt@gmail.com>
     * @since 2019/09/05
     */
    public static function formatReserveList($reserves)
    {
        $reserve_list = [];
        foreach ($reserves as $reserve) {
            array_push($reserve_list, date("j", strtotime($reserve["date"])));
        }
        return $reserve_list;
    }
}

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
     * ReserveVillaテーブルから指定villa_idのレコードを一件取得するクエリです。
     *
     * @param int $villa_id 引数として、取得したい予約記録を返します。
     * @return array $result 結果情報を連想配列で指定します。
     * @throws DBALException
     * @author wkmkymt <wkmkymt@gmail.com>
     * @since 2019/09/05
     */
    public function getReserveByVilla($villa_id, $reserve_date)
    {

        // Villa_idを指定して取得するクエリを作成
        $sql = "select *
                    from reserve
                    where date_format(reserve.date, '%Y-%m') = date_format(:date, '%Y-%m')";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        // villa_idを指定します
        // $statement->bindParam(":id", $villa_id, PDO::PARAM_INT);

        // reserve_dateを指定します
        $statement->bindValue(":date", $reserve_date, PDO::PARAM_STR);

        // SQLを実行
        $statement->execute();

        // 結果レコードを一件取得し、返送
        return $statement->fetchAll();
    }

    /**
     * getPastReserveByVilla Function
     *
     * Reserveテーブルから指定user_idの今日までのレコードを全件取得するクエリです。
     *
     * @param int $user_id 引数として、取得したい予約記録を指定します。
     * @return array $result 結果情報を連想配列を返します。
     * @throws DBALException
     * @author wkmkymt <wkmkymt@gmail.com>
     * @since 2019/09/06
     */
    public function getPastReserveByUser($user_id)
    {
        // user_idを指定して取得するクエリを作成
        $sql = "select reserve.date, villa.id, villa.name, villa.image_path
                    from reserve inner join villa on reserve.villa_id = villa.id
                    where reserve.date <= now() and user_id = :id";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        // user_idを指定します
        $statement->bindParam(":id", $user_id, PDO::PARAM_INT);

        // SQLを実行
        $statement->execute();

        // 結果レコードを一件取得し、返送
        return $statement->fetchAll();
    }

    /**
     * getFutureReserveByVilla Function
     *
     * Reserveテーブルから指定user_idの明日以降のレコードを全件取得するクエリです。
     *
     * @param int $user_id 引数として、取得したい予約記録を指定します。
     * @return array $result 結果情報を連想配列を返します。
     * @throws DBALException
     * @author wkmkymt <wkmkymt@gmail.com>
     * @since 2019/09/06
     */
    public function getFutureReserveByUser($user_id)
    {
        // user_idを指定して取得するクエリを作成
        $sql = "select reserve.date, villa.id, villa.name, villa.image_path
                    from reserve inner join villa on reserve.villa_id = villa.id
                    where reserve.date > now() and user_id = :id";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        // user_idを指定します
        $statement->bindParam(":id", $user_id, PDO::PARAM_INT);

        // SQLを実行
        $statement->execute();

        // 結果レコードを一件取得し、返送
        return $statement->fetchAll();
    }

    public static function formatReserveList($reserves)
    {
        $reserve_list = [];
        foreach ($reserves as $reserve) {
            array_push($reserve_list, date("j", strtotime($reserve["date"])));
        }
        return $reserve_list;
    }
}

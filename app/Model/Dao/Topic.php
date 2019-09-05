<?php

namespace Model\Dao;

use Doctrine\DBAL\DBALException;
use PDO;



/**
 * Class Topic
 *
 * Topicテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @author wkmkymt <wkmkymt@gmail.com>
 * @since 2019/09/05
 * @package Model\Dao
 */
class Topic extends Dao
{

    /**
     * getTopicList Function
     *
     * Topicテーブルにあるアイテム一覧を取得するためのサンプルです。
     *
     * @return array $result 結果情報を連想配列で指定します。
     * @throws DBALException
     * @author wkmkymt <wkmkymt@gmail.com>
     * @since 2019/09/05
     */
    public function getTopicList()
    {

        // 全件取得するクエリを作成
        $sql = "select villa.name, villa.description, villa.image_path
                    from topic inner join villa on topic.villa_id = villa.id";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        // SQLを実行
        $statement->execute();

        // 結果レコードを全件取得し、返送
        return $statement->fetchAll();
    }
}

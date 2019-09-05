<?php

namespace Model\Dao;

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
     * searchByKeyword Function
     *
     * キーワード検索をおこないます。
     * 対象は名称、詳細文言です。
     *
     * @param $keyword
     * @return mixed
     * @throws \Doctrine\DBAL\DBALException
     * @copyright Ceres inc.
     * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
     * @since 2019/09/05
     */

    public function searchByKeyword($keyword)
    {

        //SQL
        $sql = "Select 
                    id,
                    name,
                    image_path,
                    LEFT(description,50) as description
                 from villa 
                where name like :keyword or description like :keyword";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        //部分一致検索にするため％で囲みます。
        $keyword = "%" . $keyword . "%";

        //キーワードを指定します
        $statement->bindParam(":keyword", $keyword, PDO::PARAM_STR);

        //SQLを実行
        $statement->execute();

        //結果レコードを一件取得し、返送
        return $statement->fetchAll();
    }
}

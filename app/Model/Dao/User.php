<?php

namespace Model\Dao;

use Doctrine\DBAL\DBALException;
use PDO;

/**
 * Class User
 *
 * Userテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @copyright Ceres inc.
 * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
 * @since 2018/08/28
 * @package Model\Dao
 */
class User extends Dao
{

  /**
   * getUser Function
   *
   * Userテーブルから指定idのレコードを一件取得するクエリです。
   *
   * @param int $id 引数として、取得したい商品のアイテムIDを指定します。
   * @return array $result 結果情報を連想配列で指定します。
   * @throws DBALException
   * @author wkmkymt <wkmkymt@gmail.com>
   * @since 2019/09/05
   */

  public function getUser($user_id)
  {

    // user_idを指定して取得するクエリを作成
    $sql = "select * from user where id =:id";

    // SQLをプリペア
    $statement = $this->db->prepare($sql);

    // idを指定します
    $statement->bindParam(":id", $user_id, PDO::PARAM_INT);

    // SQLを実行
    $statement->execute();

    // 結果レコードを一件取得し、返送
    return $statement->fetch();
  }

  /**
   * getUser Function
   *
   * Userテーブルから指定idのレコードを一件取得するクエリです。
   *
   * @param int $id 引数として、取得したい商品のアイテムIDを指定します。
   * @return array $result 結果情報を連想配列で指定します。
   * @throws DBALException
   * @author wkmkymt <wkmkymt@gmail.com>
   * @since 2019/09/05
   */

  public function getVillaByUser($user_id)
  {

    // user_idを指定して取得するクエリを作成
    $sql = "select villa.*
                    from user_villa
                        left join villa on user_villa.villa_id = villa.id
                    where user_villa.user_id = :id";

    // SQLをプリペア
    $statement = $this->db->prepare($sql);

    // idを指定します
    $statement->bindParam(":id", $user_id, PDO::PARAM_INT);

    // SQLを実行
    $statement->execute();

    // 結果レコードを一件取得し、返送
    return $statement->fetchAll();
  }
}

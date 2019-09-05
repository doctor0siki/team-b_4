<?php

namespace Model;

/**
 * Class calendar
 *
 * calendar Classです
 *
 * @copyright Ceres inc.
 * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
 * @since 2019/09/04
 * @package Model
 */
class Calendar
{

    /**
     * getCalArray Function
     *
     * 指定日のカレンダーを配列で取得します
     *
     * @param int $ymcode 201908
     * @return array
     * @since 2019/09/04
     * @copyright Ceres inc.
     * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
     */

    public static function getCalArray($ymcode)
    {
        // 現在の年月を取得
        $year = date('Y', strtotime($ymcode . "01"));
        $month = date('n', strtotime($ymcode . "01"));

        // 月末日を取得
        $last_day = date('t', strtotime($ymcode . "01"));

        $data = array();

        $j = 0;

        // 月末日までループ
        for ($i = 1; $i < $last_day + 1; $i++) {

            // 曜日を取得
            $week = date('w', mktime(0, 0, 0, $month, $i, $year));

            // 1日の場合
            if ($i == 1) {

                // 1日目の曜日までをループ
                for ($s = 1; $s <= $week; $s++) {

                    // 前半に空文字をセット
                    $data[$j]['day'] = '';
                    $j++;
                }
            }

            // 配列に日付をセット
            $data[$j]['day'] = $i;
            $j++;

            // 月末日の場合
            if ($i == $last_day) {

                // 月末日から残りをループ
                for ($e = 1; $e <= 6 - $week; $e++) {

                    // 後半に空文字をセット
                    $data[$j]['day'] = '';
                    $j++;
                }
            }
        }

        $data["month_name"] = date('Y年m月', strtotime($ymcode . "01"));
        return $data;
    }
}

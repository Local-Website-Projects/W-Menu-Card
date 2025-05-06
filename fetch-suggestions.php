<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");

if (isset($_GET['query']) && isset($_GET['location_id'])) {
    $query = $_GET['query'];
    $location_id = $_GET['location_id'];

    $datas = $db_handle->runQuery("SELECT * FROM users WHERE restaurant_name LIKE '%$query%' AND availability = 1 AND status = 1 AND type = 1 AND location = '$location_id'");

    if ($datas) {
        $suggestions = array();
        foreach ($datas as $data) {
            $id = $data['user_id'];
            $count_item = $db_handle->numRows("SELECT * FROM `items` WHERE `user_id` = '$id'");
            if ($count_item > 0) {
                $suggestions[] = $data['restaurant_name'];
            }
        }
        echo json_encode($suggestions);
    }
}
?>

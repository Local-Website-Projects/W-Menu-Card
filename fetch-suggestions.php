<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$updated_at = date("Y-m-d H:i:s");


if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $datas = $db_handle->runQuery("select * from users where restaurant_name like '%$query%'");


    $suggestions = array();
    foreach ($datas as $data) {
        $suggestions[] = $data['restaurant_name'];
    }

    echo json_encode($suggestions);
}
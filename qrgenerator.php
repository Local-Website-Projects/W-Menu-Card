<?php
require_once('config/dbConfig.php');
$db_handle = new DBController();
require 'vendor/qr/qrlib.php'; // Adjust the path to where you have the PHP QR Code library

// Create directory to save QR codes if it doesn't exist
$dir = 'restaurant_code';
if (!file_exists($dir)) {
    mkdir($dir, 0755, true);
}

$code = '2';
$filePath = $dir . '/' . $code . '.png';
$link = 'https://menusz.com/View-Menu?user=2';
QRcode::png($link, $filePath, QR_ECLEVEL_L, 10);
echo "Generated QR code for: $code\n";



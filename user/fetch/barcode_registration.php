<?php
include("../connection.php");

$sql = "SELECT MAX(qrcode) AS last_qrcode FROM products";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$last_qrcode = $row['last_qrcode'] ?? 1000000000;

header('Content-Type: application/json');
echo json_encode(["last_qrcode" => $last_qrcode]);
?>

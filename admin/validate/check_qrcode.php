<?php
include("../connection.php");

// Fetch the last QR code from the products table
$query = "SELECT product_qr FROM products ORDER BY product_qr DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $new_qr = (int)$row["product_qr"] + 1; // Increment the last QR code
} else {
    $new_qr = 1000000001; // Start from this number if no QR exists
}

echo json_encode(["new_qr" => $new_qr]);
$conn->close();
?>

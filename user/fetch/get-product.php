<?php
// Display all errors for debugging (optional)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure 'identifier' is passed in the request
if (!isset($_GET['identifier'])) {
    echo json_encode(['success' => false, 'message' => 'No identifier provided']);
    exit;
}

$identifier = $_GET['identifier'];

// Database connection
$mysqli = new mysqli("localhost", "root", "", "starbright");
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Query to fetch product details
$query = "SELECT * FROM products WHERE barcode = ? OR qrcode = ?";
$stmt = $mysqli->prepare($query);
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Database query preparation failed']);
    exit;
}

$stmt->bind_param("ss", $identifier, $identifier);
$stmt->execute();
$result = $stmt->get_result();

// Check if product is found
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    echo json_encode(['success' => true, 'product' => $product]);
} else {
    echo json_encode(['success' => false, 'message' => 'Product not found']);
}

$stmt->close();
$mysqli->close();
?>

<?php
// get_product.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // DB connection (adjust as needed)
    $conn = new mysqli("localhost", "root", "", "starbright");

    if ($conn->connect_error) {
        echo json_encode(["success" => false, "message" => "DB connection failed"]);
        exit;
    }

    // Adjusted table name and field name to match your `products` table
    $stmt = $conn->prepare("SELECT name, slug, image FROM products WHERE product_qr = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode(["success" => true, "product" => $row]);
    } else {
        echo json_encode(["success" => false, "message" => "Product not found"]);
    }

    $stmt->close();
    $conn->close();
}
?>

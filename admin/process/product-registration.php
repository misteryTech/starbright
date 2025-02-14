<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");

header("Content-Type: application/json");
ob_end_clean(); // Clean output before JSON

$response = ["status" => "error", "message" => "Unknown error occurred"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$conn) {
        $response["message"] = "Database connection failed: " . mysqli_connect_error();
        echo json_encode($response);
        exit;
    }

    // Fetch and sanitize inputs
    $productName = mysqli_real_escape_string($conn, $_POST["productname"]);
    $qrcode = mysqli_real_escape_string($conn, $_POST["qrcode"]);
    $slug = mysqli_real_escape_string($conn, $_POST["slug"]);
    $itemcode = mysqli_real_escape_string($conn, $_POST["itemcode"]);
    $barcode = mysqli_real_escape_string($conn, $_POST["barcode"]);
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $type = isset($_POST["variation"]) && $_POST["variation"] === "true" ? "variation" : "single";

    // Function to return value or "N/A"
    function getValue($conn, $value, $default = "N/A") {
        return empty($value) ? $default : mysqli_real_escape_string($conn, $value);
    }

    $weight = getValue($conn, $_POST["weight"]);
    $length = getValue($conn, $_POST["length"]);
    $width = getValue($conn, $_POST["width"]);
    $height = getValue($conn, $_POST["height"]);
    $unit = getValue($conn, $_POST["unit"]);
    $description = getValue($conn, $_POST["description"]);
    $stockstatus = getValue($conn, $_POST["stock_status"]);

    // Insert into products table
    $sql = "INSERT INTO products (product_name, slug, qrcode, itemcode, barcode, weight, length, width, height, unit, category, description, type, stock_status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "ssssssssssssss",
            $productName, $slug, $qrcode, $itemcode, $barcode,
            $weight, $length, $width, $height, $unit,
            $category, $description, $type, $stockstatus
        );

        if ($stmt->execute()) {
            $productId = $stmt->insert_id;
            $stmt->close();

            // ✅ Handle multiple variations
            if ($type === "variation" && isset($_POST["variations"]) && is_array($_POST["variations"])) {
                $variationSql = "INSERT INTO products_variation 
                                 (product_id, variation_name, variation_value, barcode, itemcode, stock_status, unit, weight, length, width, height, description) 
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                if ($variationStmt = $conn->prepare($variationSql)) {
                    foreach ($_POST["variations"] as $variation) {
                        $variationName = mysqli_real_escape_string($conn, $variation["variation_name"]);
                        $variationValue = mysqli_real_escape_string($conn, $variation["variation_value"]);
                        $variationBarcode = getValue($conn, $variation["barcode"]);
                        $variationItemCode = getValue($conn, $variation["itemcode"]);
                        $variationStockStatus = getValue($conn, $variation["stock_status"]);
                        $variationUnit = getValue($conn, $variation["unit"]);
                        $variationWeight = getValue($conn, $variation["weight"]);
                        $variationLength = getValue($conn, $variation["length"]);
                        $variationWidth = getValue($conn, $variation["width"]);
                        $variationHeight = getValue($conn, $variation["height"]);
                        $variationDescription = getValue($conn, $variation["description"]);

                        $variationStmt->bind_param(
                            "isssssssssss",
                            $productId, $variationName, $variationValue, $variationBarcode, $variationItemCode,
                            $variationStockStatus, $variationUnit, $variationWeight, $variationLength, $variationWidth,
                            $variationHeight, $variationDescription
                        );

                        if (!$variationStmt->execute()) {
                            error_log("❌ Variation Insert Failed: " . $variationStmt->error);
                        } else {
                            error_log("✅ Variation Inserted: Product ID: $productId, Variation: $variationName");
                        }
                    }
                    $variationStmt->close();
                } else {
                    $response["message"] = "Variation SQL Prepare Failed: " . $conn->error;
                    echo json_encode($response);
                    exit;
                }
            }

            $response["status"] = "success";
            $response["message"] = "✅ Product and variations registered successfully!";
        } else {
            $response["message"] = "Execution Failed: " . $stmt->error;
        }
    } else {
        $response["message"] = "SQL Prepare Failed: " . $conn->error;
    }
}

$conn->close();
echo json_encode($response);
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");

header("Content-Type: application/json");
ob_end_clean();

$response = ["status" => "error", "message" => "Unknown error occurred"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$conn) {
        $response["message"] = "Database connection failed: " . mysqli_connect_error();
        echo json_encode($response);
        exit;
    }

    // Get and sanitize the input data
    $productName = mysqli_real_escape_string($conn, $_POST["productname"]);
    $qrcode = mysqli_real_escape_string($conn, $_POST["qrcode"]);
    $slug = mysqli_real_escape_string($conn, $_POST["slug"]);
    $itemcode = mysqli_real_escape_string($conn, $_POST["itemcode"]);
    $barcode = mysqli_real_escape_string($conn, $_POST["barcode"]);
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $type = isset($_POST["variation"]) && $_POST["variation"] === "true" ? "variation" : "single";

    // Helper function to return default values if necessary
    function getValue($conn, $value, $default = "N/A") {
        return empty($value) ? $default : mysqli_real_escape_string($conn, $value);
    }

    // Assigning values for product fields
    $weight = getValue($conn, $_POST["weight"]);
    $length = getValue($conn, $_POST["length"]);
    $width = getValue($conn, $_POST["width"]);
    $height = getValue($conn, $_POST["height"]);
    $unit = getValue($conn, $_POST["unit"]);
    $description = getValue($conn, $_POST["description"]);
    $stockstatus = getValue($conn, $_POST["stock_status"]);

    // Insert query for the product
    $sql = "INSERT INTO products (product_name, slug, qrcode, itemcode, barcode, weight, length, width, height, unit, category, description, type, stock_status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "ssssssssssssss",
            $productName, $slug, $qrcode, $itemcode, $barcode,
            $weight, $length, $width, $height, $unit,
            $category, $description, $type, $stockstatus
        );

        if ($stmt->execute()) {
            $productId = $stmt->insert_id;  // Get the product ID after insertion
            $stmt->close();

            // Insert variation only if the product type is "variation"
            if ($type === "variation" && isset($_POST["variation"])) {
                // Ensure the correct SQL query and values for variations
                $variationSql = "INSERT INTO products_variation (product_id, product_variation, attribute_value) VALUES (?, ?, ?)";

                // Make sure the variation data is passed correctly
                $productionVariation = isset($_POST["productionVariations"]) ? $_POST["productionVariations"] : "default";  // Use the name of the input field for variationsc
                $variation_values = isset($_POST["variation_values"]) ? $_POST["variation_values"] : "default";  // Use the name of the input field for variationsc

                // Prepare and execute the query for inserting variations
                if ($variationStmt = $conn->prepare($variationSql)) {   
                    $variationStmt->bind_param("iii", $productId, $productionVariation, $variation_values);

                    if (!$variationStmt->execute()) {
                        error_log("❌ Variation Insert Failed: " . $variationStmt->error);
                    } else {
                        error_log("✅ Variation Inserted: Product ID: $productId, Variation: $productionVariation");
                    }

                    $variationStmt->close();
                } else {
                    $response["message"] = "Variation SQL Prepare Failed: " . $conn->error;
                    echo json_encode($response);
                    exit;
                }
            }

            $response["status"] = "success";
            $response["message"] = "Product and variations registered successfully!";
        } else {
            $response["message"] = "Product Insertion Failed: " . $stmt->error;
        }
    } else {
        $response["message"] = "SQL Prepare Failed: " . $conn->error;
    }
}

$conn->close();
echo json_encode($response);
?>

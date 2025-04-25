<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include('../connection.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debugging: print the POST data to check values
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    // Get product ID
    if (isset($_POST['productId'])) {
        $productId = $_POST['productId'];
    } else {
        die("Missing productId.");
    }

    // Handle product images
    $productImages = [];
    $uploadsDir = 'uploads/';

    if (isset($_FILES['product_img']['name'])) {
        for ($i = 0; $i < count($_FILES['product_img']['name']); $i++) {
            $fileName = basename($_FILES['product_img']['name'][$i]);
            $targetFilePath = $uploadsDir . $fileName;
            if (move_uploaded_file($_FILES['product_img']['tmp_name'][$i], $targetFilePath)) {
                $productImages[] = $fileName;
            }
        }
    }

    // Check if itemcode and values are set and not empty
    if (!isset($_POST['itemcode']) || !isset($_POST['values'])) {
        die("Missing required stock values.");
    }

    $itemcodes = $_POST['itemcode'];
    $values = $_POST['values'];
    $barcodes = $_POST['barcode'];
    $statuses = $_POST['status'];
    $weights = $_POST['weight'];
    $lengths = $_POST['length'];
    $widths = $_POST['width'];
    $heights = $_POST['height'];
    $descriptions = $_POST['description'];

    // Loop through itemcodes and values
    for ($i = 0; $i < count($itemcodes); $i++) {
        $itemcode = trim($itemcodes[$i]);
        $value = trim($values[$i]);
        $barcode = isset($barcodes[$i]) ? trim($barcodes[$i]) : '';
        $status = isset($statuses[$i]) ? trim($statuses[$i]) : '';
        $weight = isset($weights[$i]) ? (float) $weights[$i] : 0;
        $length = isset($lengths[$i]) ? (float) $lengths[$i] : 0;
        $width = isset($widths[$i]) ? (float) $widths[$i] : 0;
        $height = isset($heights[$i]) ? (float) $heights[$i] : 0;
        $description = isset($descriptions[$i]) ? trim($descriptions[$i]) : '';

        // Handle additional images
        $additionalImages = [];
        if (isset($_FILES['additional_img']['name'][$i])) {
            for ($j = 0; $j < count($_FILES['additional_img']['name']); $j++) {
                $additionalFileName = basename($_FILES['additional_img']['name'][$j]);
                $additionalTargetFilePath = $uploadsDir . $additionalFileName;
                if (move_uploaded_file($_FILES['additional_img']['tmp_name'][$j], $additionalTargetFilePath)) {
                    $additionalImages[] = $additionalFileName;
                }
            }
        }

        // Insert into database
        $insertStockQuery = "INSERT INTO stock (product_id, values, product_img, additional_img, itemcode, barcode, status, weight, length, width, height, description)
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertStockQuery);
        $productImagesStr = implode(",", $productImages);
        $additionalImagesStr = implode(",", $additionalImages);

        $stmt->bind_param(
            "sssssssssdds", 
            $productId, 
            $value, 
            $productImagesStr, 
            $additionalImagesStr, 
            $itemcode, 
            $barcode, 
            $status, 
            $weight, 
            $length, 
            $width, 
            $height, 
            $description
        );

        $stmt->execute();
    }

    echo "Stock has been updated successfully!";
} else {
    echo "Invalid request method.";
}
?>

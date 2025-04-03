<?php
// Include database connection
include('../connection.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<h3>🔍 Debugging Submitted Data:</h3>";
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";

    // Get product ID
    $productId = $_POST['productId'] ?? null;
    
    if (!$productId) {
        die("<p>❌ Error: Product ID is missing.</p>");
    }

    // Handle product images
    $productImages = [];
    $uploadsDir = 'uploads/';

    if (!empty($_FILES['product_img']['name'][0])) {
        foreach ($_FILES['product_img']['name'] as $index => $fileName) {
            $targetFilePath = $uploadsDir . basename($fileName);
            if (move_uploaded_file($_FILES['product_img']['tmp_name'][$index], $targetFilePath)) {
                $productImages[] = $fileName;
            } else {
                echo "<p>⚠️ Warning: Failed to upload product image: $fileName</p>";
            }
        }
    }

    // Ensure `values[]` exists and is not empty
    if (empty($_POST['values']) || !is_array($_POST['values'])) {
        die("<p>❌ Error: Values[] is missing or empty.</p>");
    }

    // Ensure stock-related data exists
    if (empty($_POST['itemcode']) || !is_array($_POST['itemcode'])) {
        die("<p>❌ Error: No item codes provided.</p>");
    }

    // Assign form data
    $itemcodes = $_POST['itemcode'];
    $barcodes = $_POST['barcode'] ?? [];
    $statuses = $_POST['status'] ?? [];
    $weights = $_POST['weight'] ?? [];
    $lengths = $_POST['length'] ?? [];
    $widths = $_POST['width'] ?? [];
    $heights = $_POST['height'] ?? [];
    $descriptions = is_array($_POST['description']) ? $_POST['description'] : [$_POST['description']];
    $values = $_POST['values'];

    foreach ($itemcodes as $i => $itemcode) {
        $barcode = $barcodes[$i] ?? '';
        $status = $statuses[$i] ?? '';
        $weight = $weights[$i] ?? 0;
        $length = $lengths[$i] ?? 0;
        $width = $widths[$i] ?? 0;
        $height = $heights[$i] ?? 0;
        $description = $descriptions[$i] ?? '';
        $value = $values[$i] ?? '';

        // Debugging: Print processed data
        echo "<h4>📌 Processing Item $i:</h4>";
        echo "<p>✔️ Item Code: $itemcode</p>";
        echo "<p>✔️ Barcode: $barcode</p>";
        echo "<p>✔️ Status: $status</p>";
        echo "<p>✔️ Weight: $weight</p>";
        echo "<p>✔️ Length: $length</p>";
        echo "<p>✔️ Width: $width</p>";
        echo "<p>✔️ Height: $height</p>";
        echo "<p>✔️ Description: $description</p>";
        echo "<p>✔️ Value: $value</p>";

        // Handle additional images
        $additionalImages = [];
        if (!empty($_FILES['additional_img']['name'][$i])) {
            $fileName = basename($_FILES['additional_img']['name'][$i]);
            $targetFilePath = $uploadsDir . $fileName;
            if (move_uploaded_file($_FILES['additional_img']['tmp_name'][$i], $targetFilePath)) {
                $additionalImages[] = $fileName;
            } else {
                echo "<p>⚠️ Warning: Failed to upload additional image: $fileName</p>";
            }
        }

        // Convert images to comma-separated strings
        $productImagesStr = implode(",", $productImages);
        $additionalImagesStr = implode(",", $additionalImages);

        // Insert into database
        $insertStockQuery = "INSERT INTO stock 
            (product_id, product_img, additional_img, itemcode, barcode, `status`, `weight`, `length`, width, height, `description`, `attribute_values`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertStockQuery);
        if ($stmt) {
            $stmt->bind_param(
                "ssssssssddss",
                $productId,
                $productImagesStr,
                $additionalImagesStr,
                $itemcode,
                $barcode,
                $status,
                $weight,
                $length,
                $width,
                $height,
                $description,
                $value
            );

            if ($stmt->execute()) {
                echo "<p>✅ Stock for item $itemcode has been successfully added.</p>";
            } else {
                echo "<p>❌ Error inserting stock data: " . $stmt->error . "</p>";
            }
        } else {
            echo "<p>❌ Database error: " . $conn->error . "</p>";
        }
    }
} else {
    echo "<p>❌ Invalid request method.</p>";
}
?>

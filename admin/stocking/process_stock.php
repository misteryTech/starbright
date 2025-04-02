<?php
// Include database connection
include('../connection.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get product ID
    $productId = $_POST['productId'];

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

    // Handle stock values
    if (isset($_POST['itemcode'])) {
        
        $itemcodes = $_POST['itemcode'];
        $barcodes = $_POST['barcode'];
        $statuses = $_POST['status'];
        $weights = $_POST['weight'];
        $lengths = $_POST['length'];
        $widths = $_POST['width'];
        $heights = $_POST['height'];
        $descriptions = $_POST['description'];

        for ($i = 0; $i < count($itemcodes); $i++) {
            $itemcode = $itemcodes[$i];
            $barcode = $barcodes[$i];
            $status = $statuses[$i];
            $weight = $weights[$i];
            $length = $lengths[$i];
            $width = $widths[$i];
            $height = $heights[$i];
            $description = $descriptions[$i];

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
            $insertStockQuery = "INSERT INTO stock (product_id, product_img, additional_img, itemcode, barcode, status, weight, length, width, height, description)
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertStockQuery);
           $productImagesStr = implode(",", $productImages);
$additionalImagesStr = implode(",", $additionalImages);

$stmt->bind_param(
    "ssssssssdds",
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
    $description
);

            $stmt->execute();
        }
    }

    echo "Stock has been updated successfully!";
} else {
    echo "Invalid request method.";
}
?>

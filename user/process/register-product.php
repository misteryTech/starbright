<?php
include("../connection.php");
session_start();

require_once('../../phpqrcode-master/qrlib.php'); // Include the QR Code library

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'];
    $productSlug = $_POST['product_slug'];
    $productBrand = $_POST['product_brand'];
    $productCategory = $_POST['product_category'];
    $productQR = $_POST['product_qr'];

    // Ensure the QR code directory exists
    $qrDir = "uploads/qrcode/";
    if (!is_dir($qrDir)) {
        mkdir($qrDir, 0777, true);
    }

    // Generate QR Code and save it as an image
    $qrImageName = time() . '_qr.png';
    $qrImagePath = $qrDir . $qrImageName;
    QRcode::png($productQR, $qrImagePath, QR_ECLEVEL_L, 10);

    // Handle product image upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageName = time() . '_' . basename($_FILES['product_image']['name']);
        $imageTmpName = $_FILES['product_image']['tmp_name'];
        $imagePath = $uploadDir . $imageName;

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['product_image']['type'], $allowedTypes)) {
            $_SESSION['error'] = "Invalid image format (only JPG, PNG, GIF allowed).";
            header("Location: ../product.php");
            exit();
        }

        if ($_FILES['product_image']['size'] > 2 * 1024 * 1024) {
            $_SESSION['error'] = "Image file is too large (max 2MB).";
            header("Location: ../product.php");
            exit();
        }

        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $imagePath = "uploads/" . $imageName;
        } else {
            $_SESSION['error'] = "Failed to upload image.";
            header("Location: ../product.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "No image uploaded.";
        header("Location: ../product.php");
        exit();
    }

    // Check if QR code exists
    $checkQR = $conn->query("SELECT * FROM products WHERE product_qr = '$productQR'");
    if ($checkQR->num_rows > 0) {
        $productQR = mt_rand(1000000001, 9999999999);
    }

    // Insert product into the database
    $stmt = $conn->prepare("INSERT INTO products (name, slug, brand_id, category_id, image, product_qr, qr_code_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissss", $productName, $productSlug, $productBrand, $productCategory, $imagePath, $productQR, $qrImagePath);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Product registered successfully!";
        header("Location: ../product.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: ../product.php");
        exit();
    }
}
?>

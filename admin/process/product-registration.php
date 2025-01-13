<?php
include("../connection.php");

// Check if POST data is set
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $slug = $conn->real_escape_string($_POST['slug']);
    $type = $conn->real_escape_string($_POST['type']);
    $category = $conn->real_escape_string($_POST['category']);
    $price = $conn->real_escape_string($_POST['price']);
    $quantity = $conn->real_escape_string($_POST['quantity']);
    $unit = $conn->real_escape_string($_POST['unit']);
    $description = $conn->real_escape_string($_POST['description']);
    $barcode = $conn->real_escape_string($_POST['barcode']);
    $qrcode = $conn->real_escape_string($_POST['barcode']);

    // Handle optional image upload
    $imagePath = NULL;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = uniqid() . "_" . basename($_FILES['image']['name']);
        $targetDir = "uploads/";
        $imagePath = $targetDir . $imageName;

        // Create uploads directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Move uploaded file to the target directory
        if (!move_uploaded_file($imageTmpName, $imagePath)) {
            die("Error uploading image.");
        }
    }

    // Insert query
    $sql = "INSERT INTO products (name, slug, type, category, price, quantity, unit, description, barcode, qrcode, image_path) 
            VALUES ('$name', '$slug', '$type', '$category', '$price', '$quantity', '$unit', '$description', '$barcode', '$qrcode', '$imagePath')";

    if ($conn->query($sql) === TRUE) {
        echo "Product registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

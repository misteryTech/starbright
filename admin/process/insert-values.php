<?php
session_start(); // Start the session
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attributeId = $_POST['attribute_id'];
    $values = $_POST['values'];

    if (!empty($attributeId) && !empty($values) && is_array($values)) {
        foreach ($values as $value) {
            $value = $conn->real_escape_string($value);
            $sql = "INSERT INTO attribute_values (attribute_id, value) VALUES ('$attributeId', '$value')";
            $conn->query($sql);
        }

        // Set session success message
        $_SESSION['success'] = "Values inserted successfully.";

        // Redirect to attributes.php
        header("Location: ../attributes.php");
        exit(); // Stop script execution after redirect
    } else {
        echo "Invalid data provided.";
    }
}
?>

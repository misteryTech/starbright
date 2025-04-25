<?php
include("../connection.php");

// Get slug from request
$slug = isset($_GET['slug']) ? mysqli_real_escape_string($conn, $_GET['slug']) : '';

// Query to check if slug exists
$sql = "SELECT COUNT(*) AS count FROM products WHERE slug = '$slug'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $exists = $row['count'] > 0;
    echo json_encode(["exists" => $exists]);
} else {
    echo json_encode(["error" => "Query failed."]);
}

// Close connection
mysqli_close($conn);
?>

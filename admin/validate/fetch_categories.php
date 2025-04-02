<?php
include("../connection.php");

if (isset($_GET['brand_id'])) {
    $brandId = intval($_GET['brand_id']);

    // Fetch categories from attribute_values based on selected brand
    $sql = "SELECT id, value FROM attribute_values WHERE attribute_id = $brandId";
    $result = $conn->query($sql);

    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = ['id' => $row['id'], 'value' => htmlspecialchars($row['value'])];
    }

    echo json_encode($categories); // Return JSON response
}
?>

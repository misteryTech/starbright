<?php
include("../connection.php");

header('Content-Type: application/json'); // Set response type to JSON

if (isset($_GET['variationName'])) {
    $attributeId = intval($_GET['variationName']); // Convert to integer for safety

    // Query to fetch attribute values based on attribute ID
    $query = "SELECT id, value FROM attribute_values WHERE attribute_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $attributeId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $values = [];
    while ($row = $result->fetch_assoc()) {
        $values[] = [
            'id' => $row['id'],
            'value' => $row['value']
        ];
    }
    
    echo json_encode(["attributeId" => $attributeId, "values" => $values]);
} else {
    echo json_encode(["error" => "Missing variationName parameter"]);
}
?>

<?php
include("../connection.php");

if (isset($_GET['id'])) {
    $attributeId = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT value FROM attribute_values WHERE attribute_id = ?");
    $stmt->bind_param("i", $attributeId);
    $stmt->execute();
    $result = $stmt->get_result();

    $values = [];
    while ($row = $result->fetch_assoc()) {
        $values[] = $row['value'];
    }

    echo json_encode(['values' => $values]);

    $stmt->close();
    $conn->close();
}
?>

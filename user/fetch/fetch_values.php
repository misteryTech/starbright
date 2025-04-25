
<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attributeId = $_POST['attribute_id'] ?? '';

    if (empty($attributeId)) {
        echo "Error: No attribute ID received.";
        exit;
    }

    $query = "SELECT id, `value` FROM attribute_values WHERE attribute_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $attributeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['value']) . '</option>';
        }
    } else {
        echo "Error: No values found for attribute ID " . htmlspecialchars($attributeId);
    }
}
?>

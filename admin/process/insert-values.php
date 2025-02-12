<?php
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
        echo "Values inserted successfully.";
    } else {
        echo "Invalid data provided.";
    }
}
?>

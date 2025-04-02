<?php
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['attribute_id'])) {
    $attribute_id = $_POST['attribute_id'];

    $sql = "SELECT id, `value` FROM attribute_values WHERE attribute_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $attribute_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['value'] . '</option>';
    }
}
?>

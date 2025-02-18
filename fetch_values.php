<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=sample', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the attribute ID
$attributeId = isset($_GET['attribute_id']) ? (int) $_GET['attribute_id'] : 0;

// Fetch values for the selected attribute
$stmt = $pdo->prepare("SELECT * FROM attribute_values WHERE attribute_id = ?");
$stmt->execute([$attributeId]);
$values = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return as JSON
echo json_encode($values);
?>

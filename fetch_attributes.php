<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=sample', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch attributes from the database
$stmt = $pdo->query("SELECT * FROM attributes");
$attributes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return as JSON
echo json_encode($attributes);
?>

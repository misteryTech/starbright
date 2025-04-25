<?php

include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $name = $_POST['name'];
  $slug = $_POST['slug'];
  $type = $_POST['type'];

  // You can insert the data into your database here
  // For simplicity, we will just echo a success message
 // Insert query
 $sql = "INSERT INTO attributes (attribute_name, slug, type) 
 VALUES ('$name', '$slug', '$type')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success']);
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}


// Close the connection
$conn->close();

}
?>

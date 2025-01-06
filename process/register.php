<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Secure the password (hashing for security)


    // Prepare and bind the statement
    $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $username, $password);

    // Execute the query
    if ($stmt->execute()) {
            echo"<script>Alert Succesfully Registered</script>";
            header("Location: ../sign-up.php"); // Admin dashboard
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

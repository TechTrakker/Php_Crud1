<?php
include('db1.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Prepare and bind the query
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect with a success_add parameter
        header("Location: crud1.php?success_add=true");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

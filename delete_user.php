<?php
include('db1.php'); // Include database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $query = "DELETE FROM users WHERE id='$id'";
    if ($conn->query($query) === TRUE) {
        // Redirect with success_delete parameter
        header('Location: crud1.php?success_delete=true');
    } else {
        // Error handling
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    // If no id is passed
    echo "No user ID provided for deletion.";
}
?>

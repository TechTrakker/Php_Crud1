<?php
include('db1.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update query
    $query = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id='$id'";
    if ($conn->query($query) === TRUE) {
        // Redirect with success_edit parameter
        header('Location: crud1.php?success_edit=true');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

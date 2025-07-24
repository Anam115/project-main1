<?php
include("../db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    echo "No user ID provided.";
}
?>

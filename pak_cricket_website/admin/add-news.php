<?php
include("db.php");
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $detail = $_POST['detail'];

    $stmt = $conn->prepare("INSERT INTO news (title, description, image_url, detail) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $image_url, $detail);
    $stmt->execute();
    header("Location: manage-news.php");
    exit;
}
?>

<form method="POST">
    <input type="text" name="title" placeholder="News Title" required><br>
    <textarea name="description" placeholder="Short Description" required></textarea><br>
    <input type="text" name="image_url" placeholder="Image URL"><br>
    <textarea name="detail" placeholder="Full Detail" required></textarea><br>
    <button type="submit">Add News</button>
</form>

<?php
include("db.php");
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM news WHERE id=$id");
$news = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $detail = $_POST['detail'];

    $stmt = $conn->prepare("UPDATE news SET title=?, description=?, image_url=?, detail=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $description, $image_url, $detail, $id);
    $stmt->execute();
    header("Location: manage-news.php");
    exit;
}
?>

<form method="POST">
    <input type="text" name="title" value="<?= $news['title'] ?>" required><br>
    <textarea name="description" required><?= $news['description'] ?></textarea><br>
    <input type="text" name="image_url" value="<?= $news['image_url'] ?>"><br>
    <textarea name="detail" required><?= $news['detail'] ?></textarea><br>
    <button type="submit">Update News</button>
</form>

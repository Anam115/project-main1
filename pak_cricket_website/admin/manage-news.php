<?php
include("db.php");
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM news ORDER BY id DESC");
?>

<a href="add-news.php">+ Add News</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['title'] ?></td>
        <td><?= $row['description'] ?></td>
        <td><img src="<?= $row['image_url'] ?>" width="100" /></td>
        <td>
            <a href="edit-news.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="delete-news.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this news?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

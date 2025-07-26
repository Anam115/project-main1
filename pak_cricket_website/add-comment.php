<?php
include 'admin/db.php';
session_start();
$user_id = $_SESSION['user_id'];
$question_id = $_POST['question_id'];
$comment = mysqli_real_escape_string($conn, $_POST['comment']);

$conn->query("INSERT INTO comments (question_id, user_id, comment) VALUES ($question_id, $user_id, '$comment')");

header("Location: discussion-detail.php?id=$question_id");
?>
<?php
include('../db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $conn->query("INSERT INTO questions (question) VALUES ('$question')");
    header("Location: ../discussion.php");
}
?>
<form method="POST">
  <textarea name="question" class="w-full p-2 border" required></textarea>
  <button type="submit" class="bg-blue-600 text-white px-4 py-1 mt-2 rounded">Post Question</button>
</form>
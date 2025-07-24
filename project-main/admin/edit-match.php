<?php
include('../db.php');
$id = $_GET['id'];
$match = $conn->query("SELECT * FROM matches WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $match_date = $_POST['match_date'];
    $status = $_POST['status'];

    $sql = "UPDATE matches SET team1='$team1', team2='$team2', match_date='$match_date', status='$status' WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: match-list.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<form method="POST" class="max-w-xl mx-auto mt-10 space-y-4">
  <h2 class="text-2xl font-bold mb-4">Edit Match</h2>
  <input type="text" name="team1" value="<?= $match['team1'] ?>" required class="w-full border p-2">
  <input type="text" name="team2" value="<?= $match['team2'] ?>" required class="w-full border p-2">
  <input type="datetime-local" name="match_date" value="<?= date('Y-m-d\TH:i', strtotime($match['match_date'])) ?>" required class="w-full border p-2">
  <select name="status" required class="w-full border p-2">
    <option value="live" <?= $match['status'] == 'live' ? 'selected' : '' ?>>Live</option>
    <option value="upcoming" <?= $match['status'] == 'upcoming' ? 'selected' : '' ?>>Upcoming</option>
    <option value="completed" <?= $match['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
  </select>
  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Match</button>
</form>

<?php
include('../db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $match_date = $_POST['match_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO matches (team1, team2, match_date, status)
            VALUES ('$team1', '$team2', '$match_date', '$status')";
    if ($conn->query($sql)) {
        header("Location: match-list.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<form method="POST" class="max-w-xl mx-auto mt-10 space-y-4">
  <h2 class="text-2xl font-bold mb-4">Add Match</h2>
  <input type="text" name="team1" placeholder="Team 1" required class="w-full border p-2">
  <input type="text" name="team2" placeholder="Team 2" required class="w-full border p-2">
  <input type="datetime-local" name="match_date" required class="w-full border p-2">
  <select name="status" required class="w-full border p-2">
    <option value="">Select Status</option>
    <option value="live">Live</option>
    <option value="upcoming">Upcoming</option>
    <option value="completed">Completed</option>
  </select>
  <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add Match</button>
</form>

<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('db.php');

$match_id = $_GET['id'];
$result = $conn->query("SELECT * FROM schedule WHERE id = $match_id");
$match = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $match_date = $_POST['match_date'];
    $time = $_POST['time'];
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $team1_flag = $_POST['team1_flag'];
    $team2_flag = $_POST['team2_flag'];
    $venue = $_POST['venue'];
    $series_name = $_POST['series_name'];
    $result = $_POST['result'];
    $status = $_POST['status'];

    $sql = "UPDATE schedule SET 
            match_date='$match_date', 
            time='$time', 
            team1='$team1', 
            team2='$team2', 
            team1_flag='$team1_flag', 
            team2_flag='$team2_flag', 
            venue='$venue', 
            series_name='$series_name', 
            result='$result', 
            status='$status' 
            WHERE id=$match_id";

    if ($conn->query($sql)) {
        header("Location: match-list.php");
        exit;
    } else {
        echo "Error updating match: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Match</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">
  <div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Update Match</h2>
    <form method="POST">
      <input type="date" name="match_date" value="<?= $match['match_date'] ?>" required class="w-full p-2 border mb-2">
      <input type="text" name="time" value="<?= $match['time'] ?>" required class="w-full p-2 border mb-2">
      <input type="text" name="team1" value="<?= $match['team1'] ?>" required class="w-full p-2 border mb-2">
      <input type="text" name="team1_flag" value="<?= $match['team1_flag'] ?>" class="w-full p-2 border mb-2">
      <input type="text" name="team2" value="<?= $match['team2'] ?>" required class="w-full p-2 border mb-2">
      <input type="text" name="team2_flag" value="<?= $match['team2_flag'] ?>" class="w-full p-2 border mb-2">
      <input type="text" name="venue" value="<?= $match['venue'] ?>" required class="w-full p-2 border mb-2">
      <input type="text" name="series_name" value="<?= $match['series_name'] ?>" class="w-full p-2 border mb-2">
      <input type="text" name="result" value="<?= $match['result'] ?>" class="w-full p-2 border mb-2">
      <select name="status" required class="w-full p-2 border mb-4">
        <option value="upcoming" <?= $match['status'] == 'upcoming' ? 'selected' : '' ?>>Upcoming</option>
        <option value="completed" <?= $match['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
      </select>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Match</button>
    </form>
  </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include('db.php');
$result = $conn->query("SELECT * FROM schedule ORDER BY match_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Matches</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 p-6">
  <div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Manage Matches</h1>
      <a href="add-match.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add Match</a>
    </div>

    <table class="w-full border border-gray-300 bg-white shadow-md">
      <thead class="bg-gray-200">
        <tr>
          <th class="p-2 text-left">Date</th>
          <th class="p-2 text-left">Time</th>
          <th class="p-2 text-left">Teams</th>
          <th class="p-2 text-left">Venue</th>
          <th class="p-2 text-left">Series</th>
          <th class="p-2 text-left">Status</th>
          <th class="p-2 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr class="border-t">
            <td class="p-2"><?= $row['match_date'] ?></td>
            <td class="p-2"><?= $row['time'] ?></td>
            <td class="p-2 flex items-center gap-2">
              <img src="<?= $row['team1_flag'] ?>" class="w-5 h-3"> <?= $row['team1'] ?> 
              <span class="text-gray-500">vs</span> 
              <?= $row['team2'] ?> <img src="<?= $row['team2_flag'] ?>" class="w-5 h-3">
            </td>
            <td class="p-2"><?= $row['venue'] ?></td>
            <td class="p-2"><?= $row['series_name'] ?></td>
            <td class="p-2"><?= ucfirst($row['status']) ?></td>
            <td class="p-2 space-x-2">
              <a href="update-match.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
              <a href="delete-match.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this match?')" class="text-red-600 hover:underline">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>

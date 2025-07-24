<?php
include('../db.php');
$result = $conn->query("SELECT * FROM matches ORDER BY match_date DESC");
?>
<h2 class="text-2xl font-bold my-4 text-center">All Matches</h2>
<a href="add-match.php" class="bg-green-600 text-white px-4 py-2 rounded ml-4">+ Add Match</a>
<table class="w-full mt-4 border">
  <tr class="bg-gray-200">
    <th class="p-2 border">Team 1</th>
    <th class="p-2 border">Team 2</th>
    <th class="p-2 border">Date</th>
    <th class="p-2 border">Status</th>
    <th class="p-2 border">Actions</th>
  </tr>
  <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td class="p-2 border"><?= $row['team1'] ?></td>
      <td class="p-2 border"><?= $row['team2'] ?></td>
      <td class="p-2 border"><?= $row['match_date'] ?></td>
      <td class="p-2 border capitalize"><?= $row['status'] ?></td>
      <td class="p-2 border">
        <a href="edit-match.php?id=<?= $row['id'] ?>" class="text-blue-600">Edit</a> |
        <a href="delete-match.php?id=<?= $row['id'] ?>" class="text-red-600">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>

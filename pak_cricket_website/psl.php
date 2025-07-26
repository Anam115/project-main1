<?php include 'admin/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PSL - Pakistan Cricket</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<!-- Navbar -->
<header class="sticky top-0 bg-green-700 text-white p-4 z-50">
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-2xl font-bold">🏏 Pakistan Cricket</h1>
    <nav class="space-x-4">
      <a href="home.php" class="hover:underline">Home</a>
      <a href="schedule.php" class="hover:underline">Schedule</a>
      <a href="players.php" class="hover:underline">Players</a>
      <a href="psl.php" class="hover:underline font-semibold underline">PSL</a>
      <a href="news.php" class="hover:underline">News</a>
    </nav>
  </div>
</header>

<!-- PSL Team Cards -->
<section class="py-12 px-4">
  <h2 class="text-3xl font-bold text-center text-green-700 mb-10">Pakistan Super League Teams</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
    <?php
    $teams = $conn->query("SELECT * FROM psl_teams");
    while ($team = $teams->fetch_assoc()):
    ?>
    <a href="<?= $team['page_link'] ?>" class="bg-white p-6 rounded-lg shadow hover:scale-105 transition text-center">
      <img src="<?= $team['logo'] ?>" alt="<?= $team['name'] ?>" class="w-24 h-24 mx-auto mb-3 rounded-full">
      <h3 class="text-xl font-semibold"><?= $team['name'] ?></h3>
      <p class="text-gray-600">PSL Team</p>
    </a>
    <?php endwhile; ?>
  </div>
</section>

<!-- Points Table -->
<?php
$points = $conn->query("
  SELECT psl_points.*, psl_teams.name 
  FROM psl_points 
  JOIN psl_teams ON psl_points.team_id = psl_teams.id
");
?>
<section class="py-12 px-4 bg-white">
  <h2 class="text-3xl font-bold text-center text-green-700 mb-8">PSL Points Table</h2>
  <div class="overflow-x-auto">
    <table class="w-full table-auto border border-collapse border-green-700 text-sm text-center">
      <thead class="bg-green-700 text-white">
        <tr>
          <th class="p-2 border">Team</th>
          <th class="p-2 border">Matches</th>
          <th class="p-2 border">Wins</th>
          <th class="p-2 border">Losses</th>
          <th class="p-2 border">Ties</th>
          <th class="p-2 border">No Result</th>
          <th class="p-2 border">Points</th>
          <th class="p-2 border">NRR</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $points->fetch_assoc()): ?>
        <tr class="hover:bg-gray-100">
          <td class="p-2 border font-semibold"><?= $row['name'] ?></td>
          <td class="p-2 border"><?= $row['matches'] ?></td>
          <td class="p-2 border"><?= $row['wins'] ?></td>
          <td class="p-2 border"><?= $row['losses'] ?></td>
          <td class="p-2 border"><?= $row['ties'] ?></td>
          <td class="p-2 border"><?= $row['no_result'] ?></td>
          <td class="p-2 border"><?= $row['points'] ?></td>
          <td class="p-2 border"><?= $row['nrr'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</section>

<!-- PSL Schedule -->
<?php
$psl_schedule = $conn->query("SELECT * FROM psl_schedule WHERE match_type = 'PSL' ORDER BY match_date ASC");
if ($psl_schedule && $psl_schedule->num_rows > 0):
?>
<section class="py-12 px-4 bg-gray-50">
  <h2 class="text-3xl font-bold text-center text-green-700 mb-8">PSL Match Schedule</h2>
  <div class="max-w-4xl mx-auto">
    <table class="w-full table-auto border-collapse border border-green-700 text-sm text-center">
      <thead class="bg-green-700 text-white">
        <tr>
          <th class="p-2 border">Date</th>
          <th class="p-2 border">Teams</th>
          <th class="p-2 border">Venue</th>
          <th class="p-2 border">Time</th>
        </tr>
      </thead>
      <tbody>
        <?php while($match = $psl_schedule->fetch_assoc()): ?>
        <tr class="hover:bg-gray-100">
          <td class="p-2 border"><?= date('d M Y', strtotime($match['match_date'])) ?></td>
          <td class="p-2 border"><?= $match['team1'] ?> vs <?= $match['team2'] ?></td>
          <td class="p-2 border"><?= $match['venue'] ?></td>
          <td class="p-2 border"><?= $match['time'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</section>
<?php endif; ?>

</body>
</html>

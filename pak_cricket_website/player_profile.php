<?php
include 'admin/db.php';
$player_id = $_GET['id'];
$formats = ['T20', 'ODI', 'Test'];
$player = $conn->query("SELECT * FROM players WHERE id=$player_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $player['name'] ?> Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function showStats(format) {
      const sections = document.querySelectorAll('.stat-section');
      sections.forEach(sec => sec.classList.add('hidden'));
      document.getElementById(format).classList.remove('hidden');
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

  <!-- Navbar -->
  <header class="sticky top-0 bg-green-700 text-white p-4 z-10 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold">🏏 Pakistan Cricket</h1>
      <nav class="space-x-4 text-sm md:text-base">
        <a href="home.php" class="hover:underline">Home</a>
        <a href="schedule.php" class="hover:underline">Schedule</a>
        <a href="players.php" class="hover:underline underline font-bold">Players</a>
        <a href="psl.php" class="hover:underline">PSL</a>
        <a href="news.php" class="hover:underline">News</a>
      </nav>
    </div>
  </header>

  <!-- Player Header -->
  <section class="max-w-6xl mx-auto bg-green-700 rounded-lg overflow-hidden shadow-lg text-white mt-6">
    <div class="flex flex-col md:flex-row items-center md:items-start p-6">
      <img src="images/<?= $player['image'] ?>" alt="<?= $player['name'] ?>" class="w-64 rounded-lg shadow-lg border-4 border-white">
      <div class="ml-0 md:ml-6 mt-4 md:mt-0 text-center md:text-left">
        <h1 class="text-4xl font-bold uppercase"><?= $player['name'] ?></h1>
        <p class="mt-2 text-lg"><strong>Nationality:</strong> <?= $player['nationality'] ?></p>
        <p class="mt-1"><strong>Born:</strong> <?= $player['born'] ?></p>
        <p class="mt-1"><strong>Role:</strong> <?= $player['role'] ?></p>
        <p class="mt-1"><strong>Batting Style:</strong> <?= $player['batting_style'] ?></p>
        <p class="mt-1"><strong>Bowling Style:</strong> <?= $player['bowling_style'] ?></p>
      </div>
    </div>
  </section>

  <!-- Match Format Selector -->
  <section class="max-w-6xl mx-auto mt-6 bg-white rounded-lg p-4 shadow-lg text-green-700 ">
    <h2 class="text-2xl font-semibold mb-4">Match Details</h2>
    <div class="flex flex-wrap gap-4">
      <?php foreach ($formats as $format): ?>
        <button onclick="showStats('<?= $format ?>')" class="px-4 py-2 bg-green-700 hover:bg-green-600 text-white rounded font-semibold transition-all duration-200"><?= $format ?></button>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Stats Sections -->
  <section class="max-w-6xl mx-auto mt-4">
    <?php foreach ($formats as $format): 
      $stat = $conn->query("SELECT * FROM player_stats WHERE player_id=$player_id AND format='$format'")->fetch_assoc();
      if (!$stat) continue;
    ?>
    <div id="<?= $format ?>" class="stat-section <?= $format !== 'T20' ? 'hidden' : '' ?> bg-white text-green-800 mt-4 p-6 rounded-lg shadow-lg">
      <h3 class="text-xl font-bold mb-4 text-green-700"><?= $format ?> Statistics</h3>
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 text-center">
        <div><div class="text-green-600 text-2xl font-bold"><?= $stat['matches'] ?></div><div>Matches</div></div>
        <div><div class="text-green-600 text-2xl font-bold"><?= $stat['runs'] ?></div><div>Runs</div></div>
        <div><div class="text-green-600 text-2xl font-bold"><?= $stat['wickets'] ?></div><div>Wickets</div></div>
        <div><div class="text-green-600 text-2xl font-bold"><?= $stat['strike_rate'] ?></div><div>Strike Rate</div></div>
        <div><div class="text-green-600 text-2xl font-bold"><?= $stat['average'] ?></div><div>Average</div></div>
        <div><div class="text-green-600 text-2xl font-bold"><?= $stat['highest_score'] ?></div><div>High Score</div></div>
        <div><div class="text-green-600 text-2xl font-bold"><?= $stat['fifties'] ?></div><div>Fifties</div></div>
        <div><div class="text-green-600 text-2xl font-bold"><?= $stat['hundreds'] ?></div><div>Hundreds</div></div>
        <div><div class="text-green-600 text-2xl font-bold"><?= $stat['sixes'] ?></div><div>Sixes</div></div>
        <div><div class="text-green-600 text-2xl font-bold"><?= $stat['fours'] ?></div><div>Fours</div></div>
      </div>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- Player Overview -->
  <section class=" max-w-6xl mx-auto mt-10 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-green-600 p-6 rounded-lg shadow-lg">
      <div class="flex justify-center">
        <img src="images/<?= $player['image'] ?>" alt="<?= $player['name'] ?>" class="w-64  h-auto object-cover rounded-lg">
      </div>
      <div>
        <h2 class="text-2xl font-bold text-white mb-4">Player Overview</h2>
        <p class="text-white leading-relaxed text-justify whitespace-pre-line">
          <?= nl2br($player['overview']) ?>
        </p>
      </div>
    </div>
  </section>

  <!-- Back Button (Moved to Bottom) -->
  <div class="max-w-6xl mx-auto my-10 text-center">
    <a href="players.php" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-lime-500 hover:from-green-600 hover:to-lime-600 text-white font-semibold px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Players
    </a>
  </div>

</body>
</html>

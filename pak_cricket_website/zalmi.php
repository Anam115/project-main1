<?php
include 'admin/db.php';
$team_id = 1; // Peshawar Zalmi

// Get captain
$captain_result = $conn->query("SELECT * FROM psl_players WHERE team_id = $team_id AND role LIKE '%Captain%' LIMIT 1");
$captain = $captain_result->fetch_assoc();

// Get all players
$players = $conn->query("SELECT * FROM psl_players WHERE team_id = $team_id");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Peshawar Zalmi Squad</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .card {
      position: relative;
      overflow: hidden;
    }
    .card img {
      transition: transform 0.3s ease;
    }
    .card:hover img {
      transform: scale(1.05);
    }
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      background: rgba(0, 0, 0, 0.7);
      width: 100%;
      height: 100%;
      opacity: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.3s ease;
    }
    .card:hover .overlay {
      opacity: 1;
    }
    .overlay a {
      color: #FFD700;
      font-size: 1.25rem;
      font-weight: bold;
      text-decoration: underline;
    }
  </style>
</head>
<body class="bg-yellow-50 text-gray-800">

<!-- ✅ Navbar -->
<header class="sticky top-0 bg-black text-yellow-400 z-50">
  <div class="container mx-auto flex justify-between items-center px-4 py-4">
    <h1 class="text-2xl font-bold flex items-center gap-2">
      <img src="images/peshawar zalmi.jpg" alt="Zalmi Logo" class="h-10"> Peshawar Zalmi Squad
    </h1>
    <nav class="space-x-4">
      <a href="home.php" class="hover:underline">Home</a>
      <a href="schedule.php" class="hover:underline">Schedule</a>
      <a href="players.php" class="hover:underline">Players</a>
      <a href="psl.php" class="hover:underline">PSL</a>
      <a href="news.php" class="hover:underline">News</a>
    </nav>
  </div>
</header>

<!-- ✅ Hero Section for Captain -->
<?php if ($captain): ?>
<section class="bg-yellow-400 py-10">
  <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center px-4 gap-8">
    <img src="images/<?= $captain['image'] ?>" alt="<?= $captain['name'] ?>" class="w-60 h-72 object-cover rounded-lg shadow-lg">
    <div>
      <h2 class="text-3xl font-bold text-black mb-2"><?= $captain['name'] ?> <span class="text-sm text-black">(Captain)</span></h2>
      <p class="text-lg text-black mb-2"><strong>Role:</strong> <?= $captain['role'] ?></p>
      <p class="text-black">
        <?= $captain['name'] ?> is the captain of Peshawar Zalmi. A talented <?= strtolower($captain['batting_style']) ?> batter and <?= strtolower($captain['bowling_style']) ?> bowler from <?= $captain['nationality'] ?>, aged <?= $captain['age'] ?>.
      </p>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ✅ Player Cards Grid -->
<div class="max-w-7xl mx-auto px-4 py-10">
  <h2 class="text-2xl font-bold mb-6 text-yellow-900">Squad Players</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <?php while($player = $players->fetch_assoc()): ?>
    <div class="card bg-white rounded-lg shadow-md hover:shadow-xl transition">
      <img src="images/<?= $player['image'] ?>" alt="<?= $player['name'] ?>" class="w-full h-[622px] object-cover rounded-lg">
      <div class="overlay">
        <a href="psl_players_profile.php?id=<?= $player['id'] ?>"><?= $player['name'] ?></a>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

</body>
</html>

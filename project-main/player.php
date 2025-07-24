<?php
include('db.php');

// Show some players by default (optional)
$result = $conn->query("SELECT * FROM players ORDER BY id DESC LIMIT 6");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Players</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-green-700 text-white p-4">
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-2xl font-bold">🏏 Pakistan Cricket</h1>
    <nav class="space-x-4">
      <a href="index.html" class="hover:underline">Home</a>
      <a href="matches.html" class="hover:underline">Matches</a>
      <a href="players.php" class="hover:underline">Players</a>
      <a href="news.php" class="hover:underline">News</a>
    </nav>
  </div>
</header>

<section class="py-12 px-4">
  <h2 class="text-3xl font-bold text-center mb-6">Team Players</h2>

  <!-- Search -->
 <form id="searchForm" class="flex justify-center mb-6" onsubmit="return false;">
  <input
    type="text"
    id="searchInput"
    name="query"
    placeholder="Search player..."
    class="border px-4 py-2 rounded w-64"
  />
  <button type="submit" class="ml-2 bg-green-600 text-white px-4 py-2 rounded">
    Search
  </button>
</form>


  <!-- Player Cards -->
  <div id="playerCards" class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">
   <?php while ($row = $result->fetch_assoc()): ?>
  <a href="player.php?id=<?= $row['id'] ?>" class="bg-white shadow-md rounded-lg p-4 text-center block">
   <img src="images/<?= $row['image_url'] ?>" class="w-24 h-24 mx-auto rounded-full mb-2" />
    <h3 class="font-semibold"><?= $row['name'] ?></h3>
    <p><?= $row['role'] ?></p>
  </a>
<?php endwhile; ?>

  </div>
</section>

<!-- JavaScript -->
<script>
const input = document.getElementById('searchInput');
const playerCards = document.getElementById('playerCards');

// Function to fetch and render players
function fetchPlayers(query) {
  fetch('search_players.php?query=' + encodeURIComponent(query))
    .then(response => response.json())
    .then(data => {
      playerCards.innerHTML = '';

      if (data.length === 0) {
        playerCards.innerHTML = '<p class="text-red-600 text-center col-span-3">No players found.</p>';
        return;
      }

      data.forEach(player => {
        playerCards.innerHTML += `
          <a href="player.php?id=${player.id}" class="block bg-white p-4 shadow rounded text-center hover:shadow-lg transition">
            <img src="${player.image_url}" class="w-24 h-24 mx-auto rounded-full mb-2" />
            <h3 class="font-semibold">${player.name}</h3>
            <p>${player.role}</p>
          </a>
        `;
      });
    });
}

// 🔍 1. Real-time search (existing)
input.addEventListener('input', function () {
  const query = this.value.trim();
  fetchPlayers(query);
});

// 🔍 2. Enter key triggers search (Step 2 added)
input.addEventListener('keypress', function (e) {
  if (e.key === 'Enter') {
    e.preventDefault(); // Optional: stop form submission
    const query = this.value.trim();
    fetchPlayers(query);
  }
});
</script>

</body>
</html>

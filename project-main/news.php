<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <?php
$conn = new mysqli("localhost", "root", "", "pak_cricket");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM news ORDER BY id DESC";
$result = $conn->query($sql);
?>
    <header class="bg-green-700 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
          <h1 class="text-2xl font-bold">🏏 Pakistan Cricket</h1>
          <nav class="space-x-4">
            <a href="index.html" class="hover:underline">Home</a>
            <a href="matches.html" class="hover:underline">Matches</a>
            <a href="players.html" class="hover:underline">Players</a>
            <a href="psl.html" class="hover:underline">PSL</a>
            <a href="news.html" class="hover:underline">News</a>
            <a href="#" class="hover:underline">Contact</a>
          </nav>
        </div>
      </header>
    <!-- News Page -->
<section class="py-12 px-4 bg-gray-50">
    <h2 class="text-3xl font-bold text-center mb-6">Latest Cricket News</h2>
  
    <!-- News Cards -->
    <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">
      <?php while($row = $result->fetch_assoc()) { ?>
        <div class="bg-white p-4 shadow rounded">
            <img src="<?php echo $row['image_url']; ?>" class="w-full h-40 object-cover rounded mb-3" />
            <h3 class="font-semibold text-lg"><?php echo $row['title']; ?></h3>
            <p class="text-sm"><?php echo $row['description']; ?></p>
            <a href="<?php echo $row['detail_link']; ?>" class="text-green-700 font-semibold">Read More</a>
        </div>
        <?php } ?>

      <!-- <div class="bg-white p-4 shadow rounded">
        <img src="https://example.com/news1.jpg" class="w-full h-40 object-cover rounded mb-3" />
        <h3 class="font-semibold text-lg">Babar Azam breaks record!</h3>
        <p class="text-sm">Babar becomes fastest to 5000 ODI runs in cricket history...</p>
        <a href="#" class="text-green-700 font-semibold">Read More</a>
      </div> -->
      <!-- More news cards -->
    </div>
  </section>
  
</body>
</html>
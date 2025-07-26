<?php
include('admin/db.php');
$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
  echo "News not found.";
  exit;
}
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title><?= $row['title'] ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-green-700 text-white p-4">
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-2xl font-bold">🏏 Pakistan Cricket</h1>
    <nav class="space-x-4">
      <a href="home.php" class="hover:underline">Home</a>
      <a href="players.php" class="hover:underline">Players</a>
      <a href="psl.php" class="hover:underline">PSL</a>
      <a href="news.php" class="hover:underline font-semibold">News</a>
    </nav>
  </div>
</header>

<section class="py-12 px-4 bg-white max-w-4xl mx-auto">
  <img src="<?= $row['image_url'] ?>" class="w-full h-80 object-cover rounded mb-4" />
  <h2 class="text-3xl font-bold mb-2"><?= $row['title'] ?></h2>
  <p class="text-gray-600 mb-4"><?= $row['created_at'] ?></p>
  <div class="text-lg leading-7"><?= nl2br($row['detail']) ?></div>
</section>

</body>
</html>

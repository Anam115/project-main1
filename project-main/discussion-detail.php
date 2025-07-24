<?php
include('db.php');
session_start();
$id = $_GET['id'];
$q = $conn->query("SELECT * FROM questions WHERE id = $id")->fetch_assoc();

$c_result = $conn->query("
  SELECT c.comment, c.created_at, u.username 
  FROM comments c 
  JOIN users u ON u.id = c.user_id 
  WHERE c.question_id = $id 
  ORDER BY c.created_at DESC
");
?>
<h2 class="text-xl font-bold"><?= htmlspecialchars($q['question']) ?></h2>
<?php if (isset($_SESSION['user_id'])) { ?>
  <form action="add-comment.php" method="POST" class="mt-4">
    <input type="hidden" name="question_id" value="<?= $id ?>">
    <textarea name="comment" required class="w-full p-2 border rounded" placeholder="Write your comment..."></textarea>
    <button type="submit" class="bg-green-600 text-white px-4 py-1 mt-2 rounded">Post Comment</button>
  </form>
<?php } else { ?>
  <p class="text-red-500 mt-4">Please <a href="login.php" class="underline">login</a> to comment.</p>
<?php } ?>

<div class="mt-6">
  <h3 class="text-lg font-semibold mb-2">All Comments</h3>
  <?php while($c = $c_result->fetch_assoc()) { ?>
    <div class="mb-3 border-b pb-2">
      <p class="font-bold"><?= $c['username'] ?> <span class="text-sm text-gray-500">(<?= $c['created_at'] ?>)</span></p>
      <p><?= htmlspecialchars($c['comment']) ?></p>
    </div>
  <?php } ?>
</div>
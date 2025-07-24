<?php
include('db.php');
$questions = $conn->query("SELECT * FROM questions ORDER BY created_at DESC");
?>
<h2 class="text-2xl font-bold mb-4">🏏 Cricket Fan Discussions</h2>
<ul>
  <?php while($q = $questions->fetch_assoc()) { ?>
    <li class="mb-3">
      <a href="discussion-detail.php?id=<?= $q['id'] ?>" class="text-blue-600 underline">
        <?= htmlspecialchars($q['question']) ?>
      </a>
    </li>
  <?php } ?>
</ul>
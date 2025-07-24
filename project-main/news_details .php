<?php
$conn = new mysqli("localhost", "root", "", "pak_cricket");
$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id = $id";
$result = $conn->query($sql);
$news = $result->fetch_assoc();
?>

<h2><?php echo $news['title']; ?></h2>
<p><?php echo $news['description']; ?></p>
<img src="<?php echo $news['image_url']; ?>" alt="news image" />

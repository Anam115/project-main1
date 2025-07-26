<?php
include 'admin/db.php';
$query = $_GET['query'] ?? '';

$stmt = $conn->prepare("SELECT id, name, image FROM players WHERE name LIKE CONCAT('%', ?, '%')");
$stmt->bind_param("s", $query);
$stmt->execute();
$result = $stmt->get_result();

$players = [];

while ($row = $result->fetch_assoc()) {
    $players[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'image_url' => 'image/' . $row['image']
    ];
}

echo json_encode($players);
?>

<?php
include('db.php');

// Get search query from the URL (e.g., ?query=Babar)
$query = $_GET['query'] ?? '';

// Sanitize the input (basic security)
$query = trim($query);
$query = htmlspecialchars($query);

// Search query in the players table
$sql = "SELECT * FROM players WHERE name LIKE '%$query%'";
$result = $conn->query($sql);

// Store results in an array
$players = [];
while ($row = $result->fetch_assoc()) {
    $players[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'role' => $row['role'],
        'image_url' => 'images/' . $row['image_url'] // Ensure proper image path
    ];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($players);
?>

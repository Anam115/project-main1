<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include 'include.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-3xl font-bold mb-4">Welcome to Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="match-list.php" class="p-6 bg-white rounded shadow hover:bg-blue-100">
            🏏 Manage Matches
        </a>
        <a href="users.php" class="p-6 bg-white rounded shadow hover:bg-blue-100">
            👥 Manage Users
        </a>
        <a href="news.php" class="p-6 bg-white rounded shadow hover:bg-blue-100">
            📰 Manage News
        </a>
        <a href="logout.php" class="p-6 bg-white rounded shadow hover:bg-red-100">
            🚪 Logout
        </a>
    </div>
</body>
</html>


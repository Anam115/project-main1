<?php
session_start();
include 'include.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin-dashboard.php");
        exit;
    } else {
        echo "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <form method="POST" class="bg-white p-8 shadow-md rounded w-96">
    <h2 class="text-2xl font-bold mb-4">Admin Login</h2>
    <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
    <input name="username" type="text" placeholder="Username" required class="w-full mb-4 px-4 py-2 border rounded" />
    <input name="password" type="password" placeholder="Password" required class="w-full mb-4 px-4 py-2 border rounded" />
    <button type="submit" class="bg-green-600 text-white w-full py-2 rounded">Login</button>
  </form>
</body>
</html>

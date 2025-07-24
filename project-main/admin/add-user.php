<?php
include("../db.php"); // adjust path if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // more secure
  $role = $_POST['role'];

  $sql = "INSERT INTO users (first_name, last_name, username, password, role) 
          VALUES ('$first_name', '$last_name', '$username', '$password', '$role')";

  if (mysqli_query($conn, $sql)) {
    header("Location: users.php"); // ✅ make sure this file exists in the same folder
    exit();
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add New User</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f3f3f3;
    }
    .container {
      width: 60%;
      margin: auto;
      background: white;
      padding: 20px;
      margin-top: 40px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin: 10px 0 5px;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"] {
      background-color: #15803d;
      color: white;
      border: none;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #15803d;
    }
    a.back-link {
      text-decoration: none;
      color: #15803d;
      display: inline-block;
      margin-bottom: 20px;
    }
    a.back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <a href="users.php" class="back-link">← Back to Users</a>
  <h2>Add New User</h2>

  <form method="POST" action="add-user.php"> <!-- ✅ updated action -->
    <label>First Name</label>
    <input type="text" name="first_name" required>

    <label>Last Name</label>
    <input type="text" name="last_name" required>

    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Role</label>
    <select name="role" required>
      <option value="">-- Select Role --</option>
      <option value="admin">Admin</option>
      <option value="editor">Editor</option>
    </select>

    <input type="submit" value="Add User">
  </form>
</div>
<a href="users.php"></a>

</body>
</html>

<?php
include("../db.php");

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET 
            first_name='$first_name', 
            last_name='$last_name', 
            username='$username', 
            role='$role' 
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update User</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 40px;
    }
    .container {
      background-color: #fff;
      max-width: 600px;
      margin: auto;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      background-color: #28a745;
      color: white;
      font-weight: bold;
      border: none;
      margin-top: 20px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #218838;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #007bff;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Update User</h2>
  <form method="POST">
    <label>First Name</label>
    <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>

    <label>Last Name</label>
    <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>

    <label>Username</label>
    <input type="text" name="username" value="<?php echo $user['username']; ?>" required>

    <label>Role</label>
    <select name="role" required>
      <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
      <option value="editor" <?php if ($user['role'] == 'editor') echo 'selected'; ?>>Editor</option>
    </select>

    <input type="submit" value="Update User">
  </form>

  <a href="users.php">← Back to Users</a>
</div>

</body>
</html>

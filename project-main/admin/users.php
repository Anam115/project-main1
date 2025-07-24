<?php
include("../db.php");

$sql = "SELECT * FROM users ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Users</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f3f3f3;
    }
    .container {
      width: 90%;
      margin: auto;
      background: white;
      padding: 20px;
      margin-top: 40px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 12px;
      text-align: center;
    }
    th {
      background-color: #15803d;
      color: white;
    }
    .add-btn {
      float: right;
      background: #15803d;
      color: white;
      padding: 10px 15px;
      border: none;
      text-decoration: none;
      margin-bottom: 20px;
      display: inline-block;
    }
    .add-btn:hover {
      background: #15603d;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>All Users
    <a href="add-user.php" class="add-btn">Add User</a>
  </h2>

  <table>
    <tr>
      <th>S.NO.</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Username</th>
      <th>Role</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

    <?php
    if(mysqli_num_rows($result) > 0){
      $sn = 1;
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>" . $sn++ . "</td>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "<td><a href='update-user.php?id=" . $row['id'] . "'>✏️</a></td>";
        echo "<td><a href='delete-user.php?id=" . $row['id'] . "'>🗑️</a></td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='7'>No users found.</td></tr>";
    }
    ?>
  </table>
</div>

</body>
</html>

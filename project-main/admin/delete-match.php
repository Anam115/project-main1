<?php
include('../db.php');
$id = $_GET['id'];
$conn->query("DELETE FROM matches WHERE id=$id");
header("Location: match-list.php");
?>

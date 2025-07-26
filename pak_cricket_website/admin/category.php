<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access Denied.";
    exit;
}
?>
<h2>📂 Category Management (Admin Only)</h2>
<!-- Add your category form and list here -->

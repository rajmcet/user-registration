<?php
session_start();
session_destroy(); // Destroy all session data

// Redirect to login page with a query parameter indicating a successful logout
header("Location: login.html?logout=1");
exit();
?>

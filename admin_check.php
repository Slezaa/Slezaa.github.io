<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Kontrola, jestli je uživatel přihlášený a má admin práva
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Seznam admin ID
$admin_ids = [1, 2, 3];

// Kontrola, jestli má uživatel práva admina
if (!in_array($_SESSION['id'], $admin_ids)) {
    session_destroy();
    header("Location: home.html");
    exit();
}
?>
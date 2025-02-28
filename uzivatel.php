<?php
session_start();

if (!isset($_SESSION['jmeno'])) {
    echo "Nejste přihlášen";
    exit();
}

$jmeno = $_SESSION['jmeno'];
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Vítejte</title>
</head>
<body>
    <h1>Vítejte, <?php echo htmlspecialchars($jmeno); ?>!</h1>
    <a href="logout.php">Odhlásit se</a>
</body>
</html>
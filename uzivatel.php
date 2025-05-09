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
    <title>Můj účet</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<div class="navbar">
    <h3>Moje menu</h3>
    <a href="objednavky.php">Moje objednávky</a>
    <a href="zmena_hesla.php">Změna hesla</a>
    <a href="logout.php">Odhlásit se</a>
</div>

<div class="content">
    <h1>Vítejte, <?php echo htmlspecialchars($jmeno); ?>!</h1>
    <p>Zde najdete přehled svého účtu.</p>
</div>

</body>
</html>
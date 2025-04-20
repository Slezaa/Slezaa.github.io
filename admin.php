<?php
session_start();
include 'admin_check.php';
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
    <a href="objednavky_uzivatelu.php">Objednávky</a>
    <a href="pridat_produkt.php">Přidat produkt</a>
    <a href="vsechny_produkty.php">Všechny produkty</a>
    <a href="logout.php">Odhlásit se</a>
</div>

<div class="content">
    <h1>Vítejte, jste přihlášen jako admin <?php echo htmlspecialchars($jmeno); ?> :)</h1>
</div>

</body>
</html>
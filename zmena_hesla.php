<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "Nejste přihlášen";
    exit();
}

require 'db.php';

$email = $_SESSION['email'];
$zprava = "";

// Zpracování formuláře
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stare = $_POST['stare_heslo'];
    $nove = $_POST['nove_heslo'];
    $potvrzeni = $_POST['potvrzeni_hesla'];

    if ($nove !== $potvrzeni) {
        $zprava = "Nová hesla se neshodují";
    } else {
        // Načtení aktuálního hash hesla
        $stmt = $pdo->prepare("SELECT heslo FROM uzivatel WHERE email = ?");
        $stmt->execute([$email]);
        $heslo_hash = $stmt->fetchColumn();

        if (!$heslo_hash || !password_verify($stare, $heslo_hash)) {
            $zprava = "Stávající heslo není správné";
        } else {
            // Uložení nového hesla
            $nove_hash = password_hash($nove, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE uzivatel SET heslo = ? WHERE email = ?");
            if ($stmt->execute([$nove_hash, $email])) {
                $zprava = "Heslo bylo úspěšně změněno";
            } else {
                $zprava = "Nastala chyba při změně hesla";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Změna hesla</title>
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
    <div class="form-box">
        <h2>Změna hesla</h2>
        <form action="zmena_hesla.php" method="POST">
            <label for="stare_heslo">Stávající heslo:</label>
            <input type="password" id="stare_heslo" name="stare_heslo" required>

            <label for="nove_heslo">Nové heslo:</label>
            <input type="password" id="nove_heslo" name="nove_heslo" required>

            <label for="potvrzeni_hesla">Potvrzení nového hesla:</label>
            <input type="password" id="potvrzeni_hesla" name="potvrzeni_hesla" required>

            <button type="submit">Změnit heslo</button>

            <?php if ($zprava): ?>
            <div class="zprava <?php echo ($zprava === 'Heslo bylo úspěšně změněno') ? 'success' : ''; ?>">
                <?php echo $zprava; ?>
            </div>
            <?php endif; ?>

        </form>
    </div>
</div>

</body>
</html>
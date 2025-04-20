<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $jmeno = $_POST['jmeno'];
    $prijmeni = $_POST['prijmeni'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $ulice = $_POST['ulice'];
    $mesto = $_POST['mesto'];
    $psc = $_POST['psc'];
    $heslo = password_hash($_POST['heslo'], PASSWORD_DEFAULT);

    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM uzivatel WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Email již existuje!'); window.location.href = 'register.html';</script>";
            exit();
        }

        // Insert user into the database
        $stmt = $pdo->prepare("INSERT INTO uzivatel (jmeno, prijmeni, telefon, email, ulice, mesto, psc, heslo)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$jmeno, $prijmeni, $telefon, $email, $ulice, $mesto, $psc, $heslo]);

        echo "<script>alert('Registrace proběhla úspěšně!'); window.location.href = 'register.html';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Chyba při registraci: " . $e->getMessage() . "'); window.location.href = 'register.html';</script>";
    }
}
?>

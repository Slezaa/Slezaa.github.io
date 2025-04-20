<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $heslo = $_POST['heslo'];

    try {
        $stmt = $pdo->prepare("SELECT id, jmeno, heslo FROM uzivatel WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($heslo, $user['heslo'])) {
            $_SESSION['email'] = $email;
            $_SESSION['jmeno'] = $user['jmeno'];
            $_SESSION['id'] = $user['id'];

            // admin
            $admin_ids = [1, 2, 3];
            if (in_array($user['id'], $admin_ids)) {
                header("Location: admin.php");
            } else {
                header("Location: uzivatel.php");
            }
            exit();
        } else {
            echo "<script>alert('Nesprávné přihlašovací údaje'); window.location.href = 'register.html';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Chyba databáze: " . $e->getMessage() . "');</script>";
    }
}
?>
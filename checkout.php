<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Neplatný požadavek.']);
    exit;
}

require 'db.php';

$email = $_POST['email'] ?? '';
$heslo = $_POST['heslo'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM uzivatel WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($heslo, $user['heslo'])) {
    echo json_encode(['status' => 'error', 'message' => 'Neplatné přihlašovací údaje']);
    exit;
}

$adresa = trim("{$user['ulice']}, {$user['mesto']}, {$user['psc']}");

echo json_encode([
    'status' => 'success',
    'message' => 'Přihlášení úspěšné',
    'adresa' => $adresa,
    'uzivatel_email' => $user['email']
]);
?>
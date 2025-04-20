<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Získání hodnot z formuláře
    $jmeno_produktu = $_POST['jmeno_produktu'];
    $category_id = $_POST['category_produktu'];
    $popis_produktu = $_POST['popis_produktu'];
    $pocet_v_baleni = $_POST['pocet_v_baleni'];
    $rozmery_produktu = $_POST['rozmery_produktu'];
    $cena_produktu = $_POST['cena_produktu'];

    // Zpracování obrázku
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true); // Vytvoření složky pro obrázky

    $obrazek_produktu = $_FILES['obrazek_produktu']['name'];
    $target_file = $target_dir . basename($obrazek_produktu);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Ověření typu souboru a velikosti
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif']) || $_FILES["obrazek_produktu"]["size"] > 5000000) {
        echo "❌ Neplatný typ souboru nebo soubor je příliš velký. ❌";
        exit();
    }

    // Pokusíme se nahrát obrázek
    if (!move_uploaded_file($_FILES["obrazek_produktu"]["tmp_name"], $target_file)) {
        echo "❌ Chyba při nahrávání obrázku. ❌";
        exit();
    }

    // Vložení produktu do databáze
    try {
        $stmt = $pdo->prepare("INSERT INTO produkty (jmeno, popis_produktu, cena, pocet_v_baleni, velikost, image_url, kategorie_id)
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$jmeno_produktu, $popis_produktu, $cena_produktu, $pocet_v_baleni, $rozmery_produktu, $target_file, $category_id]);

        echo "✅ Produkt byl úspěšně přidán do databáze ✅";
    } catch (PDOException $e) {
        echo "❌ Chyba při přidávání produktu: " . $e->getMessage() . " ❌";
    }
}
?>
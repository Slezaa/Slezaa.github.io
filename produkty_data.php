<?php
header("Content-Type: application/json");
require 'db.php';

// Získání hodnoty kategorie z URL parametru (pokud existuje)
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

try {
    // Pokud je vybraná kategorie, použijeme WHERE klauzuli pro filtraci
    if ($category !== 'all') {
        $stmt = $pdo->prepare("
            SELECT p.id, p.jmeno, p.popis_produktu, p.velikost, p.cena, p.image_url, k.jmeno AS kategorie
            FROM produkty p
            LEFT JOIN kategorie k ON p.kategorie_id = k.id
            WHERE k.jmeno = :category
        ");
        $stmt->bindParam(':category', $category);
    } else {
        // Pokud není vybraná kategorie, vrátíme všechny produkty
        $stmt = $pdo->query("
            SELECT p.id, p.jmeno, p.popis_produktu, p.velikost, p.cena, p.image_url, k.jmeno AS kategorie
            FROM produkty p
            LEFT JOIN kategorie k ON p.kategorie_id = k.id
        ");
    }

    $stmt->execute();
    $produkty = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($produkty);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Chyba načítání produktů: " . $e->getMessage()]);
}
?>
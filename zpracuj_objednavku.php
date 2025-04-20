<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

include 'db.php';

// Získání JSON dat
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['produkty'], $data['celkova_cena'], $data['uzivatel_email'])) {
    $produkty = $data['produkty'];
    $celkova_cena = floatval($data['celkova_cena']);
    $uzivatel_email = $data['uzivatel_email'];

    try {
        // Začneme transakci
        $pdo->beginTransaction();

        // Vložení objednávky
        $stmt = $pdo->prepare("INSERT INTO objednavky (uzivatel_email, celkova_cena, stav_objednavky) VALUES (?, ?, 'pending')");
        $stmt->execute([$uzivatel_email, $celkova_cena]);

        $order_id = $pdo->lastInsertId();

        // Připravený dotaz pro vložení položek
        $stmt_item = $pdo->prepare("INSERT INTO produkty_objednavky (objednavka_id, produkt_id, pocet, cena_za_kus) VALUES (?, ?, ?, ?)");

        foreach ($produkty as $item) {
            $product_id = intval($item['id']);
            $quantity = intval($item['quantity']);
            $price = floatval($item['price']);
            $stmt_item->execute([$order_id, $product_id, $quantity, $price]);
        }

        // Potvrzení transakce
        $pdo->commit();

        echo json_encode(['success' => true, 'message' => 'Objednávka byla úspěšně zpracována.']);
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'error' => 'Chyba při zpracování objednávky: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Chybí potřebná data.']);
}
?>

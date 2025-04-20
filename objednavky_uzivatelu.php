<?php
session_start();

include 'admin_check.php';
$jmeno = $_SESSION['jmeno'];
require_once 'db.php';

// Dotaz na objednávky uživatelů včetně produktů a informací o uživatelských údajích
$query = "
    SELECT o.id AS objednavka_id, o.stav_objednavky, o.celkova_cena, o.vytvoreno,
           u.jmeno AS uzivatel_jmeno, u.email AS uzivatel_email, u.telefon AS uzivatel_telefon,
           p.jmeno AS produkt_nazev, po.pocet, po.cena_za_kus
    FROM objednavky o
    LEFT JOIN uzivatel u ON o.uzivatel_email = u.email
    LEFT JOIN produkty_objednavky po ON o.id = po.objednavka_id
    LEFT JOIN produkty p ON po.produkt_id = p.id
    ORDER BY o.vytvoreno DESC
";

$stmt = $pdo->query($query);
$objednavky = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Sesbíraní objednávek a produktů pro jednotlivé objednávky
$objednavkyGrouped = [];

foreach ($objednavky as $obj) {
    $objednavka_id = $obj['objednavka_id'];
    if (!isset($objednavkyGrouped[$objednavka_id])) {
        $objednavkyGrouped[$objednavka_id] = [
            'stav_objednavky' => $obj['stav_objednavky'],
            'celkova_cena' => $obj['celkova_cena'],
            'vytvoreno' => $obj['vytvoreno'],
            'uzivatel_jmeno' => $obj['uzivatel_jmeno'],
            'uzivatel_email' => $obj['uzivatel_email'],
            'uzivatel_telefon' => $obj['uzivatel_telefon'],
            'produkty' => []
        ];
    }

    $objednavkyGrouped[$objednavka_id]['produkty'][] = [
        'produkt_nazev' => $obj['produkt_nazev'],
        'cena_za_kus' => $obj['cena_za_kus'],
        'pocet' => $obj['pocet']
    ];
}

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Objednávky uživatelů</title>
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
        <h1>Objednávky uživatelů</h1>

        <!-- Tabulka objednávek -->
        <table>
            <thead>
                <tr>
                    <th>ID objednávky</th>
                    <th>Jméno uživatele</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Stav objednávky</th>
                    <th>Celková cena</th>
                    <th>Datum vytvoření</th>
                    <th>Položky</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objednavkyGrouped as $orderId => $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($orderId); ?></td>
                        <td><?php echo htmlspecialchars($order['uzivatel_jmeno']); ?></td>
                        <td><?php echo htmlspecialchars($order['uzivatel_email']); ?></td>
                        <td><?php echo htmlspecialchars($order['uzivatel_telefon']); ?></td>
                        <td><?php echo htmlspecialchars($order['stav_objednavky']); ?></td>
                        <td><?php echo number_format($order['celkova_cena'], 2, ',', ' ') . " Kč"; ?></td>
                        <td><?php echo htmlspecialchars(date("d.m.Y H:i", strtotime($order['vytvoreno']))); ?></td>
                        <td>
                            <ul>
                                <?php foreach ($order['produkty'] as $item): ?>
                                    <li>
                                        <?php echo htmlspecialchars($item['produkt_nazev']); ?> - 
                                        Cena: <?php echo number_format($item['cena_za_kus'], 2, ',', ' ') . " Kč"; ?> - 
                                        Množství: <?php echo htmlspecialchars($item['pocet']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

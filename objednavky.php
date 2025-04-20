<?php
session_start();

// Kontrola přihlášení
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$uzivatel_email = $_SESSION['email'];
$jmeno = $_SESSION['jmeno'];

require_once 'db.php';

// Získání objednávek uživatele s produkty
$stmt = $pdo->prepare("
    SELECT o.id AS objednavka_id, o.stav_objednavky, o.celkova_cena, o.vytvoreno,
           p.jmeno AS produkt_nazev, po.pocet, po.cena_za_kus
    FROM objednavky o
    LEFT JOIN produkty_objednavky po ON o.id = po.objednavka_id
    LEFT JOIN produkty p ON po.produkt_id = p.id
    WHERE o.uzivatel_email = ?
    ORDER BY o.vytvoreno DESC
");
$stmt->execute([$uzivatel_email]);
$objednavky = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Sesbíraní produktů pro jednotlivé objednávky
$objednavkyGrouped = [];

foreach ($objednavky as $obj) {
    $objednavka_id = $obj['objednavka_id'];
    if (!isset($objednavkyGrouped[$objednavka_id])) {
        $objednavkyGrouped[$objednavka_id] = [
            'stav_objednavky' => $obj['stav_objednavky'],
            'celkova_cena' => $obj['celkova_cena'],
            'vytvoreno' => $obj['vytvoreno'],
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
    <title>Moje objednávky</title>
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
    <h1>Moje objednávky</h1>

    <?php if (count($objednavkyGrouped) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID objednávky</th>
                    <th>Datum vytvoření</th>
                    <th>Stav</th>
                    <th>Celková cena (Kč)</th>
                    <th>Položky</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objednavkyGrouped as $orderId => $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($orderId); ?></td>
                        <td><?php echo htmlspecialchars(date("d.m.Y H:i", strtotime($order['vytvoreno']))); ?></td>
                        <td><?php echo htmlspecialchars($order['stav_objednavky']); ?></td>
                        <td><?php echo number_format($order['celkova_cena'], 2, ',', ' ') . " Kč"; ?></td>
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
    <?php else: ?>
        <div class="zadne">Nemáte žádné objednávky.</div>
    <?php endif; ?>
</div>

</body>
</html>

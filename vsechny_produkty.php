<?php
session_start();

include 'admin_check.php';
$jmeno = $_SESSION['jmeno'];
require_once 'db.php';

// Povolené sloupce pro řazení
$allowed_sort_columns = ['jmeno', 'kategorie', 'cena'];
$allowed_orders = ['ASC', 'DESC'];

// Získání a validace hodnot
$sort_by = isset($_GET['sort_by']) && in_array($_GET['sort_by'], $allowed_sort_columns) ? $_GET['sort_by'] : 'jmeno';
$order = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC';

// Mapování aliasu "kategorie" na skutečný název sloupce
$sort_column = $sort_by === 'kategorie' ? 'kategorie.jmeno' : "produkty.$sort_by";

// Dotaz na produkty s řazením
$query = "
    SELECT produkty.id, produkty.jmeno, produkty.popis_produktu, produkty.cena,
           produkty.pocet_v_baleni, produkty.velikost, produkty.image_url,
           kategorie.jmeno AS kategorie
    FROM produkty
    LEFT JOIN kategorie ON produkty.kategorie_id = kategorie.id
    ORDER BY $sort_column $order
";

$stmt = $pdo->query($query);
$produkty = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Všechny produkty</title>
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
        <h1>Všechny produkty</h1>

        <!-- Formulář pro výběr kritéria řazení -->
        <form method="GET" action="vsechny_produkty.php" class="filter">
            <label for="sort_by">Řadit podle: </label>
            <select name="sort_by" id="sort_by" onchange="this.form.submit()">
                <option value="jmeno" <?php if ($sort_by === 'jmeno') echo 'selected'; ?>>Jméno</option>
                <option value="kategorie" <?php if ($sort_by === 'kategorie') echo 'selected'; ?>>Kategorie</option>
                <option value="cena" <?php if ($sort_by === 'cena') echo 'selected'; ?>>Cena</option>
            </select>

            <label for="order">Pořadí: </label>
            <select name="order" id="order" onchange="this.form.submit()">
                <option value="asc" <?php if ($order === 'ASC') echo 'selected'; ?>>Vzestupně</option>
                <option value="desc" <?php if ($order === 'DESC') echo 'selected'; ?>>Sestupně</option>
            </select>
        </form>

        <!-- Tabulka produktů -->
        <table>
            <thead>
                <tr>
                    <th>Jméno</th>
                    <th>Kategorie</th>
                    <th>Popis</th>
                    <th>Počet v balení</th>
                    <th>Velikost</th>
                    <th>Cena</th>
                    <th>Obrázek</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produkty as $produkt): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produkt['jmeno']); ?></td>
                    <td><?php echo htmlspecialchars($produkt['kategorie']); ?></td>
                    <td><?php echo htmlspecialchars($produkt['popis_produktu']); ?></td>
                    <td><?php echo htmlspecialchars($produkt['pocet_v_baleni']); ?></td>
                    <td><?php echo htmlspecialchars($produkt['velikost']); ?></td>
                    <td><?php echo htmlspecialchars($produkt['cena']); ?> Kč</td>
                    <td><img src="<?php echo htmlspecialchars($produkt['image_url']); ?>" alt="Obrázek" width="50"></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
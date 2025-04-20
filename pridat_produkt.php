<?php
session_start();

include 'admin_check.php';
$jmeno = $_SESSION['jmeno'];
require_once 'db.php';

$stmt = $pdo->query("SELECT id, jmeno FROM kategorie");
$kategorie = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Přidat produkt</title>
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
    <h1>Přidat nový produkt</h1>

    <form id="produktForm" enctype="multipart/form-data">
        <label for="jmeno_produktu">Jméno produktu</label>
        <input type="text" id="jmeno_produktu" name="jmeno_produktu" required>

        <label for="category_produktu">Kategorie produktu</label>
        <select id="category_produktu" name="category_produktu" required>
            <option value="">-- Vyber kategorii --</option>
            <?php foreach ($kategorie as $kategorie_radek): ?>
                <option value="<?php echo htmlspecialchars($kategorie_radek['id']); ?>">
                    <?php echo htmlspecialchars($kategorie_radek['jmeno']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="popis_produktu">Popis produktu</label>
        <textarea id="popis_produktu" name="popis_produktu" rows="4" required></textarea>

        <label for="pocet_v_baleni">Počet kusů v balení</label>
        <input type="number" id="pocet_v_baleni" name="pocet_v_baleni" required>

        <label for="rozmery_produktu">Rozměry (velikost)</label>
        <input type="text" id="rozmery_produktu" name="rozmery_produktu" required>

        <label for="cena_produktu">Cena produktu (Kč)</label>
        <input type="number" id="cena_produktu" name="cena_produktu" step="0.01" required>

        <label for="obrazek_produktu">Obrázek produktu</label>
        <input type="file" id="obrazek_produktu" name="obrazek_produktu" accept="image/*" required>

        <button type="submit">Přidat produkt</button>
    </form>
</div>

<script>
document.getElementById('produktForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('ulozit_produkt.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert('✅ Produkt byl úspěšně přidán do databáze ✅');
        document.getElementById('produktForm').reset();
    })
    .catch(error => {
        alert('❌ Chyba při přidávání produktu ❌');
        console.error(error);;
    });
});
</script>

</body>
</html>

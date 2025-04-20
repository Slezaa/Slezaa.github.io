<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Odhlášení</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<div class="box">
    <div class="message">Byl jste úspěšně odhlášen.</div>
    <a href="home.html" class="btn">Zpět na domovskou stránku</a>
</div>

</body>
</html>
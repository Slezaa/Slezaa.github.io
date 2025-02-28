<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uzivatele_fapol";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Připojení selhalo: " . $conn->connect_error);
}

$email = $_POST['email'];
$heslo = $_POST['heslo'];

$sql = "SELECT jmeno, heslo FROM uzivatele_fapol WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($heslo, $row['heslo'])) {
        $_SESSION['jmeno'] = $row['jmeno'];
        header("Location: uzivatel.php");
        exit();
    } else {
        echo "Nesprávné heslo";
    }
} else {
    echo "Uživatel nenalezen";
    echo '<br><a href="register.php">Zpět na přihlášení</a>';
}

$conn->close();
?>
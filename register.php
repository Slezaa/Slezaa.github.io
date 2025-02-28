<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uzivatele_fapol";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Připojení selhalo: " . $conn->connect_error);
}

$jmeno = $_POST['jmeno'];
$prijmeni = $_POST['prijmeni'];
$telefon = $_POST['telefon'];
$email = $_POST['email'];
$adresa = $_POST['adresa'];
$mesto = $_POST['mesto'];
$heslo = crypt($_POST['heslo'], PASSWORD_DEFAULT);

$sql = "INSERT INTO uzivatele_fapol (jmeno, prijmeni, telefon, email, adresa, mesto, heslo)
VALUES ('$jmeno', '$prijmeni', '$telefon', '$email', '$adresa', '$mesto', '$heslo')";

if ($conn->query($sql) === TRUE) {
    echo"<script>alert('Registration successful!');</script>";
} else {
    echo "<script>alert('Registration failed!');</script>";
}

$conn->close();
header("Location: register.html");
?>

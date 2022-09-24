<?php
include("../conexion.php");
$nom = $_POST["nombre"];
$email = $_POST["email"];
$pwd = $_POST["pwd"];

$checkEmail = $pdo->prepare("SELECT * FROM users");
$checkEmail->execute();
$res = $checkEmail->fetchAll(PDO::FETCH_ASSOC);
$contRep = 0;
foreach ($res as $r) {
    if ($r["email"] == $email) {
        $contRep = 1;
        echo "emailRepetido";
    }
}
//emailRepetido

if ($contRep == 0) {
    $query = $pdo->prepare("INSERT INTO users (nombre, email, pass) VALUES (:nom, :email, :pass)");
    $query->bindParam(":nom", $nom);
    $query->bindParam(":email", $email);
    $query->bindParam(":pass", $pwd);
    $query->execute();
    echo "ok";
}

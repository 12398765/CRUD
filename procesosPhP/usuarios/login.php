<?php
include("../conexion.php");
$user = $_POST["email"];
$pwd = $_POST["pwd"];

session_start();

$query = $pdo->prepare("SELECT * FROM users");
$query->execute();
$resultado = $query->fetchAll(PDO::FETCH_ASSOC);

$checkLogin = 0;
foreach ($resultado as $r) {
    if (($user == $r["email"] || $user == $r["nombre"]) && $pwd == $r["pass"]) {
        echo "ok";
        $_SESSION["autenticado"] = $r["nombre"];
        $checkLogin = 1;
    }
}

if ($checkLogin == 0) {
    echo "not ok";
}

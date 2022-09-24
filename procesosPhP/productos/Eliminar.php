<?php

//obtiene el id del body en la funcion de eliminar
$data = file_get_contents("php://input");
include("../conexion.php");

$sentencia = $pdo->prepare("SELECT * FROM productos");
$sentencia->execute();
$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
$cuenta = 0;
foreach ($resultado as $r) {
    $cuenta = $cuenta + 1;
}


if ($cuenta > 1) {
    $query = $pdo->prepare("DELETE FROM productos WHERE id= :id");
    $query->bindParam(":id", $data);
    $query->execute();
    echo "OK";
} else if ($cuenta == 1) {
    echo "solo1";
} else {
    echo "error";
}

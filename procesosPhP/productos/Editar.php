<?php

//Obtiene el id enviado con del fetch desde el body de la funcion editar
$id= file_get_contents("php://input");
require "../conexion.php";

//prepara la consulta
$query = $pdo -> prepare("SELECT * FROM productos WHERE id= :id");
//Envía la variable id a la consulta anterior
$query -> bindParam(":id", $id);
//Ejecuta la sentencia
$query -> execute();
//Obtiene los valores de la consulta. Siempre se debe usar el FETCH_ASSOC cuando se trata de traer datos de la bd.
$resultado= $query->fetch(PDO::FETCH_ASSOC);
echo json_encode($resultado);

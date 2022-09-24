<?php

if(isset($_POST)){              //Si existe el método post o si ya se envió
    $codigo= $_POST["codigo"];
    $producto= $_POST["producto"];
    $precio= $_POST["precio"];
    $cantidad= $_POST["cantidad"];
    require("../conexion.php");
    //////////////////////////////////////////
    if(empty($_POST["idp"])){
    $query= $pdo->prepare("INSERT INTO productos (codigo, producto, precio, cantidad) VALUES
    (:cod, :pro, :precio, :cantidad)");
    $query-> bindParam(":cod", $codigo);
    $query-> bindParam(":pro", $producto);
    $query-> bindParam(":precio", $precio);
    $query-> bindParam(":cantidad", $cantidad);

    //ejecutar el query
    $query->execute();
    $pdo= null;  //cerrar conexion
    echo "ok";
   }


   //Para Actualizar
   else{
    $id= $_POST["idp"];
    $query= $pdo->prepare("UPDATE productos SET codigo=:cod, producto=:pro, 
    precio=:precio, cantidad=:cantidad WHERE id=:id");
    $query-> bindParam(":cod", $codigo);
    $query-> bindParam(":pro", $producto);
    $query-> bindParam(":precio", $precio);
    $query-> bindParam(":cantidad", $cantidad);
    $query-> bindParam(":id", $id);

    $query->execute();
    $pdo= null;
    echo "modificado";   //response
   }

}

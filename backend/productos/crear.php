<?php

include("../config/db.php");

$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];
$precio = $_POST['precio'];

$sql = "INSERT INTO productos (nombre, codigo, precio)
        VALUES ('$nombre', '$codigo', '$precio')";


$conexion->query($sql);
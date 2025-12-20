<?php
$conexion = new mysqli("localhost", "root", "", "almastock");

if ($conexion->connect_error){
    die("Error de conexion");
}
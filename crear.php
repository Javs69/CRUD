<?php
require_once __DIR__ . '/conexion.php'; // Esto tambíen fue de un video y nos sirve para conectar a la base de datos

$nombre   = $_POST['nombre']   ?? '';
$apellido = $_POST['apellido'] ?? '';
$genero   = $_POST['genero']   ?? '';
$telefono = $_POST['telefono'] ?? '';

$sql = "INSERT INTO usuarios (nombre, apellido, genero, telefono) VALUES ($1,$2,$3,$4)";
$r = pg_query_params($conexion, $sql, [$nombre, $apellido, $genero, $telefono]);

if ($r) { http_response_code(201); echo 'OK'; }
else    { http_response_code(400); echo 'ERROR'; }

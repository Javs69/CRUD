<?php
require_once __DIR__ . '/conexion.php';

$id       = $_POST['id']       ?? '';
$nombre   = $_POST['nombre']   ?? '';
$apellido = $_POST['apellido'] ?? '';
$genero   = $_POST['genero']   ?? '';
$telefono = $_POST['telefono'] ?? '';

if ($id === '' || $nombre === '' || $apellido === '' || $genero === '' || $telefono === '') {
  http_response_code(422);
  exit('DATOS_INCOMPLETOS');
}

if (!ctype_digit((string)$id)) {
  http_response_code(400);
  exit('ID_INVALIDO');
}

$sql = "UPDATE usuarios
        SET nombre=$1, apellido=$2, genero=$3, telefono=$4
        WHERE id=$5";
$res = pg_query_params($conexion, $sql, [$nombre, $apellido, $genero, $telefono, (int)$id]);

if ($res === false) {
  http_response_code(400);
  exit('DB_UPDATE_ERROR: ' . pg_last_error($conexion));
}

http_response_code(200);
echo 'OK';

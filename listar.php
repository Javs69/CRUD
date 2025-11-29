<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/conexion.php';

$sql = "SELECT id, nombre, apellido, genero, telefono FROM usuarios ORDER BY id ASC";
$res = pg_query($conexion, $sql);

if ($res === false) {
  http_response_code(500);
  echo json_encode(['error' => 'Error al consultar la base de datos.']);
  exit;
}

$out = [];
while ($row = pg_fetch_assoc($res)) { $out[] = $row; }

echo json_encode($out);

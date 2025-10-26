<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../index.php';

$sql = "SELECT id, nombre, apellido, genero, telefono FROM usuarios ORDER BY id ASC";
$res = pg_query($conexion, $sql);
$out = [];
while ($row = pg_fetch_assoc($res)) { $out[] = $row; }

echo json_encode($out);

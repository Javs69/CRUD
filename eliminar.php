<?php
require_once __DIR__ . '/conexion.php';

$id = $_POST['id'] ?? '';

if ($id === '') {
  http_response_code(422);
  exit('ID_REQUERIDO');
}

if (!ctype_digit((string)$id)) {
  http_response_code(400);
  exit('ID_INVALIDO');
}

$sql = "DELETE FROM usuarios WHERE id=$1";
$res = pg_query_params($conexion, $sql, [(int)$id]);

if ($res === false) {
  http_response_code(400);
  exit('DB_DELETE_ERROR: ' . pg_last_error($conexion));
}

if (pg_affected_rows($res) === 0) {
  http_response_code(404);
  exit('NO_ENCONTRADO');
}

http_response_code(200);
echo 'OK';
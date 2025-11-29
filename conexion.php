<?php
ini_set('display_errors', '0');

$conexion = @pg_connect(
  "host=dpg-d4lhvj8gjchc73aorq80-a.oregon-postgres.render.com port=5432 dbname=crud_dmkk user=crud_dmkk_user password=mA3xbQFGTk7HEPDL0FS109ODZ8sYH2vR sslmode=require"
);

if ($conexion === false) {
  http_response_code(500);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(['error' => 'No se pudo conectar a la base de datos.']);
  exit;
}
?>

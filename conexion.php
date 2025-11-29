<?php
ini_set('display_errors', '0');

// Usa DATABASE_URL de Render si está disponible; de lo contrario, usa la cadena fija.
$defaultDsn = "host=dpg-d4lhvj8gjchc73aorq80-a.oregon-postgres.render.com port=5432 dbname=crud_dmkk user=crud_dmkk_user password=mA3xbQFGTk7HEPDL0FS109ODZ8sYH2vR sslmode=require";
$databaseUrl = getenv('DATABASE_URL');

if ($databaseUrl) {
  $parts = parse_url($databaseUrl);
  if ($parts && isset($parts['host'], $parts['path'], $parts['user'], $parts['pass'])) {
    $host = $parts['host'];
    $port = $parts['port'] ?? 5432;
    $dbname = ltrim($parts['path'], '/');
    $user = $parts['user'];
    $pass = $parts['pass'];
    $defaultDsn = "host={$host} port={$port} dbname={$dbname} user={$user} password={$pass} sslmode=require";
  }
}

$conexion = @pg_connect($defaultDsn);

if ($conexion === false) {
  http_response_code(500);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(['error' => 'No se pudo conectar a la base de datos.']);
  exit;
}
?>

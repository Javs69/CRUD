<?php
ini_set('display_errors', '0');

// Construye un DSN desde DATABASE_URL, forzando sslmode=require.
function dsnDesdeUrl(?string $url): ?string {
  if (!$url) return null;

  $parts = parse_url($url);
  if (!$parts || !isset($parts['host'], $parts['path'], $parts['user'], $parts['pass'])) {
    return null;
  }

  $host = $parts['host'];
  $port = $parts['port'] ?? 5432;
  $dbname = ltrim($parts['path'], '/');
  $user = $parts['user'];
  $pass = $parts['pass'];

  // Si en la URL ya viene sslmode, se respeta; de lo contrario, se fuerza.
  $query = [];
  if (!empty($parts['query'])) {
    parse_str($parts['query'], $query);
  }
  if (empty($query['sslmode'])) {
    $query['sslmode'] = 'require';
  }

  return sprintf(
    'host=%s port=%d dbname=%s user=%s password=%s sslmode=%s',
    $host,
    $port,
    $dbname,
    $user,
    $pass,
    $query['sslmode']
  );
}

// URL externa por defecto (Render) con sslmode=require.
$defaultDsn = 'host=dpg-d4lhvj8gjchc73ao3lm0-a.oregon-postgres.render.com port=5432 dbname=crud_dmkk user=crud_dmkk_user password=mA3xbQFGTk7HEPDL0FSlO9ODZ8sYH2vR sslmode=require';
$envDsn = dsnDesdeUrl(getenv('DATABASE_URL'));
$dsn = $envDsn ?: $defaultDsn;

$conexion = @pg_connect($dsn);

if ($conexion === false) {
  http_response_code(500);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(['error' => 'No se pudo conectar a la base de datos.']);
  exit;
}
?>

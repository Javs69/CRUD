<?php
$conexion = pg_connect("host=localhost port=5432 dbname=crud user=postgres password=200612");

if (!$conexion) {
    die("❌ Error al conectar a la base de datos");
} else {
    echo "✅ Conexión exitosa a la base de datos";
}
?>

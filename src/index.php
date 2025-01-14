<?php

$db_host = getenv( 'DB_HOST' );
$db_name = getenv( 'DB_NAME' );
$db_user = getenv( 'DB_USER' );

// Read the password file path from an environment variable
$password_file_path = getenv( 'PASSWORD_FILE_PATH' );

// Read the password from the file
$db_pass = trim( file_get_contents( $password_file_path ) );

try {
  $pdo = new PDO( "mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass );
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $sql = "";

  $output = "Database connection established.";
} catch ( PDOException $e ) {
  $output = "Unable to connect to the database server: " .
    $e->getMessage() . " in " .
    $e->getFile() . ":" . $e->getLine();
}

include __DIR__ . '/../templates/output.html.php';
<?php
require("_inc.php");

$name = $argv[1];
$password = $argv[2];

$stmt = $db->prepare('INSERT INTO users (name, password)VALUES(:name, :password);');
$stmt->bindValue(':name', $name, SQLITE3_TEXT);
$stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);

if ($stmt->execute()) {
    echo "Utworzono nowy rekord o ID: " . $db->lastInsertRowid() . "\n";
} else {
    echo "Nie udało się utworzyć rekordu: " . $stmt->errorCode();
}
?> 
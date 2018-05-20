<?php
require("_inc.php");

$id = $argv[1];
$key = $argv[2];
$value = $argv[3];

$stmt = $db->prepare('SELECT id FROM records WHERE id=:id AND user_id=:user_id');
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);

if ($row = $stmt->execute()->fetchArray()) {
    $stmt = $db->prepare('REPLACE INTO properties (record_id, key, value)VALUES(:id, :key, :value)');
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->bindValue(':key', $key, SQLITE3_TEXT);
    $stmt->bindValue(':value', $value, SQLITE3_TEXT);
    $result = $stmt->execute();
    echo "Zmodyfikowano rekord o ID: $id";
} else {
    echo "Nie udało się zmodyfikować rekordu";
}

 ?> 

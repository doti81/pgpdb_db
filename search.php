<?php
require("_inc.php");

$key = $argv[1];
$value = $argv[2];
// $sort = $argv[3];

$stmt = $db->prepare('SELECT id, key, value FROM records JOIN properties ON record_id=id WHERE key=:key AND value=:value AND user_id=:user_id');
// TODO obsługa $sort
$stmt->bindValue(':key', $key, SQLITE3_TEXT);
$stmt->bindValue(':value', $value, SQLITE3_TEXT);
$stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
$result = $stmt->execute();
while ($row = $result->fetchArray()) {
    echo $row["id"] . "\n";
}
 ?> 

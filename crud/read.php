<?php
require("_inc.php");

$id = $argv[1];

$stmt = $db->prepare('SELECT id, key, value FROM records JOIN properties ON record_id=id WHERE id=:id AND user_id=:user_id');
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
$result = $stmt->execute();
while ($row = $result->fetchArray()) {
    echo $row["key"] . " = '" . $row["value"] . "'\n";
}
 ?> 

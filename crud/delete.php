<?php
require("_inc.php");

$id = $argv[1];

$stmt = $db->prepare('DELETE FROM records WHERE id=:id AND user_id=:user_id');
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);

if ($stmt->execute() && $db->changes() == 1) {
    echo "Usunięto rekord o ID: " . $id;
} else {
    echo "Nie udało się usunąć rekordu.";
}
 ?> 

<?php
require("_inc.php");

$stmt = $db->prepare('INSERT INTO records (user_id)VALUES(:user_id);');
$stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);

if ($stmt->execute()) {
    echo "Utworzono nowy rekord o ID: " . $db->lastInsertRowid() . "\n";
} else {
    echo "Nie udało się utworzyć rekordu: " . $stmt->errorCode();
}
?> 

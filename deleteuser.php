<?php
require("_inc.php");

$user = $argv[1];

$stmt = $db->prepare ('DELETE FROM users WHERE name =:name');
$stmt->bindValue(':name', $user, SQLITE3_TEXT);


if ($stmt->execute() && $db->changes() == 1) {
    echo "Usunięto użytkownika o nazwie:" . $user;
} else {
    echo "Nie udało się usunąć użytkownika.\n";
}
 ?> 
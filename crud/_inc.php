<?php
// zainicjalizuj bazę danych jesli nie istnieje
$db = new SQLite3('database.db');
$db->exec(file_get_contents("_init.sql"));

// logowanie
if (isset($_SERVER["CRUD_LOGIN"]) && isset($_SERVER["CRUD_PASS"])) {
    $login = $_SERVER["CRUD_LOGIN"];
    $password = $_SERVER["CRUD_PASS"];
    echo "Używam zmiennych środowiskowych(user: $login) do logowania.\n";
} else {
    echo "Podaj login:";
    $login = trim(fgets(STDIN));
    echo "Podaj hasło:";
    $password = trim(fgets(STDIN));  // TODO nie wyświetlać hasła
}

$stmt = $db->prepare('SELECT * FROM users WHERE name=:login');
$stmt->bindValue(':login', $login, SQLITE3_TEXT);
$result = $stmt->execute();
if (($row = $result->fetchArray()) && password_verify($password, $row["password"])) {
    echo "Zalogowano jako '$login'\n";
    $user_id = $row["id"];
} else {
    echo "Złe hasło!\n";
    die;
}
?>
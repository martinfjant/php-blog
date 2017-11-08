<pre>
<?php
$host = '127.0.0.1';
$db   = 'blogg';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$sql = "select * from users;";
$sth = $pdo->prepare($sql);
$sth->execute();
$res = $sth->fetchAll();

$user = $res[0];

/*print_r($user);
var_dump($user);
$pass = "admin";
$hash = password_hash($pass, PASSWORD_DEFAULT);*/

if (password_verify("admin", $user['password'])) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>
</pre>
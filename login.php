<pre>
<?php
	print_r($_POST);

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

$userpass = $res[0];

// echo $userpass;
// echo $_POST;

$test = password_verify($_POST['password'], $userpass['password']);
var_dump($test);

//$hash = password_hash($pass, PASSWORD_DEFAULT);

if (password_verify($_POST['password'], $userpass['password'])) {
    echo "Välkommen". $_POST['username'];
} else {
    echo 'Invalid password.';
}
?>
</pre>
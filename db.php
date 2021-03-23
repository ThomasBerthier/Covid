<?php 

try {
    $dsn = 'mysql:dbname=tberthier_virus;host=mysql-tberthier.alwaysdata.net';
    $user = 'tberthier_site';
    $password = 'Rootrootroot';

    $DB = new PDO($dsn, $user, $password);
} catch (\Throwable $th) {
    echo $th;
}
?>
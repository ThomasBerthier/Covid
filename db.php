<?php 

include "User.php";

try {
    $dsn = 'mysql:dbname=tberthier_virus;host=mysql-tberthier.alwaysdata.net';
    $user = 'tberthier_site';
    $password = 'Rootrootroot';

    $DB = new PDO($dsn, $user, $password);
} catch (\Throwable $th) {
    echo $th;
}

$User1 = new User($DB);

if(isset($DB)){
    if (isset($_SESSION["Connected"]) && $_SESSION["Connected"]===true){
        $access = true;
        $access = $User1->deconnexion();
    }else{
        $access = false;
        $access = $User1->ConnecteToi();
    }
}else{
    echo"base";
}
?>
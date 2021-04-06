<?php 

include "User.php";
include "Personnage.php";
include "Mage.php";

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
        if(isset($_SESSION["id"])){
            $User1->setUserById($_SESSION["id"]);
        }
        $access = $User1->deconnexion();
    }else{
        $access = false;
        $access = $User1->ConnecteToi();
        //if(isset($_session["id"])){
        //    $User1->setUserById();
        //}
    }
}else{
    echo"no base";
}
?>
<?php 

try {
    $dsn = 'mysql:dbname=tberthier_virus;host=mysql-tberthier.alwaysdata.net';
    $user = 'tberthier_site';
    $password = 'Rootrootroot';

    $DB = new PDO($dsn, $user, $password);
} catch (\Throwable $th) {
    echo $th;
}

if(isset($DB)){
    if (isset($_SESSION["Connected"]) && $_SESSION["Connected"]===true){
        $access = true;
        $access = afficheFormulaireLogout($DB);
    }else{
        $access = false;
        $access = afficheFormulaireConnexion($DB);
    }
   
}else{
    echo"base";
}

function afficheFormulaireLogout($DB){
    $afficheForm = true;
    $access = true;
    if(isset($_POST["deco"])){
        $_SESSION["Connected"]=false;
        session_unset();
        session_destroy();
        afficheFormulaireConnexion($DB);
        $afficheForm = false;
        $access = false;
    }else{
        $afficheForm = true;
    }

    if($afficheForm){
    ?>
        <form action="" method="post" >
            <div >
                <input type="submit" value="Deconnexion" name="deco">
            </div>
        </form>

    <?php
    
    }

    return $access;
}

function afficheFormulaireConnexion($DB){

    $access = false;
    if( isset($_POST["nom"]) && isset($_POST["mdp"])){
        $stmt = $DB->prepare("SELECT * FROM User WHERE nom= ? AND mdp = ?");
        $stmt->execute(array($_POST["nom"], $_POST["mdp"]));
        if($tab = $stmt->fetch()){ 
            $access = true;
            $_SESSION["Connected"]=true;
            $afficheForm = false;
            afficheFormulaireLogout($DB);
        }else{
            $afficheForm = true;
        }

                    

    }else{
        $afficheForm = true;
    }
    
    if($afficheForm){
    ?>
        <form action="" method="post" >
            <div>
                <label for="nom">nom: </label>
                <input type="text" name="nom" id="">
            </div>
            <div >
                <label for="mdp">mdp: </label>
                <input type="password" name="mdp" id="">
            </div>
            <div >
                <input type="submit" value="Connexion" >
            </div>
        </form>

    <?php
    }

    return $access;
        
}
?>
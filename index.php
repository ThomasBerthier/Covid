<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
    include "db.php"; 

    if($access){
        echo 'ok '.$User1->getUserNom();
        $Perso1 = new Personnage($DB);
        $Perso1->listePerso();
        if(!$Perso1->getId()==0){
            $User1->setPersonnage($Perso1);
        }
        if(!empty($Perso1->getNom()))
            echo"tu combat avec ".$User1->getNomPerso();
    }else{
        echo "Acces au site refusé";
    }
    ?>
</body>
</html>
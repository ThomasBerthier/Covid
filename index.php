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
        $Mage1 = new Mage($DB);
        $Mage1->listePerso();
        if(!$Mage1->getId()==0){
            $User1->setPersonnage($Mage1);
            $Mage1->setMagie();
        }
        if(!empty($Mage1->getNom()))
            echo"tu combat avec ".$User1->getNomPerso();
        $Ennemi = new Personnage($DB);
        $Ennemi->setPersoById(1);
        echo"<p>Le combat contre ".$Ennemi->getNom()." commence</p>";
        $Mage1->attaque($Ennemi);
        $Mage1->attaqueMagique($Ennemi);
    }else{
        echo "Acces au site refusé";
    }
    ?>
</body>
</html>
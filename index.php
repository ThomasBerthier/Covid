<?php require 'db.php';
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
    <form action="" method="post">
        <label for="nom">nom :</label>
        <input type="text" name="nom" id="">
        <label for="mdp">msp</label>
        <input type="text" name="mdp" id="">
        <button name="submit">connexion</button>
        <?php 
        if ((isset($_SESSION)) && (isset($_SESSION["nom"]))) {
            ?><input type="submit" value="deconnexion" name="deconnexion" id="deco"><?php
        }
        ?>
    </form>

    <?php
        if (isset($_POST["submit"])) {
            if ((isset($_POST["nom"]) && ($_POST["nom"] != ""))) {
                if ((isset($_POST["mdp"]) && ($_POST["mdp"] != ""))) {
                    $stmt = $DB->prepare("SELECT * FROM User WHERE nom = ?");
                    $stmt->execute(array($_POST["nom"]));
                    $stmt = $stmt->fetch();
                    if ($stmt) {
                        if ($stmt["nom"] == $_POST["nom"]) {
                            if ($stmt["mdp"] == $_POST["mdp"]) {
                                echo"bien connecté";  
                                $_SESSION["nom"] = $stmt["nom"];
                                $_SESSION["mdp"] = $stmt["mdp"];
                                header("Refresh:0");
                            }else{
                                echo"mdp inconnu";
                            }
                        }else{
                            echo"nom inconnu";
                        }
                    }else{
                        echo"compte inconnu";
                    }
                }else{
                    echo"pas de mot de passe";
                }
            }else{
                echo"pas de nom";
            }
        }else{
            echo"form non envoyé";
        }
        if(isset($_SESSION)){
            if(isset($_POST["deconnexion"])){
                session_destroy();
                header("Refresh:0");
            }
        }
    ?>
</body>
</html>
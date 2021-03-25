<?php

    class User{

        private $_nom;
        private $_prenom;
        private $_mdp;
        private $_id;
        private $_Perso;

        protected $_DB;

        public function __construct($DB){
            $this->_DB = $DB;
        }

        public function setUser($id, $nom, $mdp, $prenom){
            $this->_id = $id;
            $this->_nom = $nom;
            $this->_mdp = $mdp;
            $this->_prenom = $prenom;
        }

        public function setUserById($id){
            $stmt = $this->_DB->prepare("SELECT * FROM User WHERE id= ?");
            $stmt->execute(array($id));
            if($tab = $stmt->fetch()){
                $this->setUser($tab["id"], $tab["nom"], $tab["mdp"], $tab["prenom"]);

                $personnage = new Personnage($this->_DB);
                $personnage->setPersoById($tab["idPerso"]);
                $this->_Perso = $personnage;
            }
        }

        public function getUserNom(){
            return $this->_nom;
        }

        public function getNomPerso(){
            return $this->_Perso->getNom();
        }

        public function setPersonnage($perso){
            $this->_Perso = $perso;
            $stmt = $this->_DB->prepare("UPDATE User SET idPerso = ? WHERE id = ?");
            $stmt->execute(array($perso->getId(), $this->_id));
        }

        public function ConnecteToi(){

            $access = false;
            if( isset($_POST["nom"]) && isset($_POST["mdp"])){
                $stmt = $this->_DB->prepare("SELECT * FROM User WHERE nom= ? AND mdp = ?");
                $stmt->execute(array($_POST["nom"], $_POST["mdp"]));
                if($tab = $stmt->fetch()){ 

                    $this->setUser($tab["id"], $tab["nom"], $tab["mdp"], $tab["prenom"]);
                    $access = true;
                    $_SESSION["id"] = $tab["id"];
                    $_SESSION["Connected"]=true;
                    $afficheForm = false;
                    $this->deconnexion();
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

        public function deconnexion(){
            $afficheForm = true;
            $access = true;
            if(isset($_POST["deco"])){
                $_SESSION["Connected"]=false;
                session_unset();
                session_destroy();
                $this->ConnecteToi();
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
    }
?>
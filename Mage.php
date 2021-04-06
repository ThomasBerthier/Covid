<?php 

    class Mage extends Personnage {
        
        private $_magie;

        public function __construct($DB){
            parent::__construct($DB);
        }

        public function setMagie(){
            $stmt=$this->_DB->prepare("SELECT * FROM Mage WHERE idPersonnage= ?");
            $stmt->execute(array($this->_id));
            $data = $stmt->fetch();
            $this->_magie = $data["magie"];
        }

        public function attaqueMagique($ennemi){
            $ennemi->_vie-=$this->_magie;
            echo "<p>il reste ".$ennemi->_vie." a l'ennemi</p>";
            $this->retour($ennemi);
        }
    }
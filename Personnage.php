<?php 

    class Personnage{

        private $_id;
        private $_nom;
        private $_niveau;
        private $_vie;

        protected $_DB;

        public function __construct($DB){
            $this->_DB = $DB;
        }

        public function setPerso($id, $nom, $vie, $niveau){
            $this->_id = $id;
            $this->_nom = $nom;
            $this->_niveau = $niveau;
            $this->_vie = $vie;
        }

        public function getId(){
            return $this->_id;
        }

        public function getNom(){
            return $this->_nom;
        }

        public function setPersoById($id){
            $stmt = $this->_DB->prepare("SELECT * FROM Personnage WHERE id= ?");
            $stmt->execute(array($id));
            if ($tab = $stmt->fetch()) {
                $this->setPerso($tab["id"], $tab["nom"], $tab["vie"], $tab["niveau"]);
            }
        }

        //liste déroulante pour les persos
        //attribue un perso 
        //retourne un objet perso
        public function listePerso(){
            $stmt = $this->_DB->query("SELECT * FROM Personnage")
            ?>
            <form action="" method="post" onchange="this.submit()">
                <select name="idPerso" id="idPerso">
                <option value="">Choix perso</option>
                    <?php
                    while ($tab = $stmt->fetch()) {
                        echo'<option value="'.$tab["id"].'">'.$tab["nom"].'</option>';
                    }
                    ?>
                </select>
            </form>
            <?php
            if(isset($_POST["idPerso"])){
                $this->setPersoById($_POST["idPerso"]);
            }
            return $this;
        }
    }

?>
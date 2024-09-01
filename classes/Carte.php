<?php

class Jeu{
    private $connexion_bdd;
    private $reussites;
    private $echecs;


    public function __construct() {
        try {
            $this->connexion_bdd = new PDO('mysql:host=localhost;dbname=memory;charset=utf8', 'root', '');
            $this->connexion_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
  }
 }
 
}
?>
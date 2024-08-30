<?php

class Carte{
    private $connexion_bdd;


    public function __construct() {
        try {
            $this->connexion_bdd = new PDO('mysql:host=localhost;dbname=memory;charset=utf8', 'root', '');
            $this->connexion_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
  }
 }
   public function inserCarte($image, $identifiant,$jeu_id) {

    $insere = "INSERT INTO cartes (image, identifiant, jeu_id) VALUES (:image, :identifiant, :jeu_id)";
    $prepar = $this->connexion_bdd->prepare($insere);
    $prepar->bindParam(':image', $image);
    $prepar->bindParam(':identifiant', $identifiant);
    $prepar->execute();

   }
   public function recuperCarteParIdentifiant($identifiant) {

    $recup = "SELECT * FROM carte WHERE identifiant = :identifiant";
    $prepar = $this->connexion_bdd->prepare($recup);
    $prepar->bindParam(':identifiant', $identifiant);
    $prepar->execute();
    return $prepar->fetchAll(PDO::FETCH_ASSOC);
   }

   public function recupererCartesPourNiveau($nombreCartes) {
    
    $nombreCartes = (int) $nombreCartes;
    $recup = "SELECT * FROM carte ORDER BY RAND() LIMIT $nombreCartes";
    $prepar = $this->connexion_bdd->prepare($recup);
    $recupar->bindValue(':nombreCartes', $nombreCartes, PDO::PARAM_INT);
    $prepar->execute();
    return $prepar->fetchAll(PDO::FETCH_ASSOC);
  
   }

}
?>
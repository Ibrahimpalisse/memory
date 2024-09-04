<?php
session_start();
class Carte
{
    private $pdo_inserCarte;

    public function __construct($pdo_inserCarte = null){
        if ($pdo_inserCarte) {
            $this->pdo_inserCarte = $pdo_inserCarte;
        } else {
            $bdd = "mysql:host=localhost;dbname=memory;charset=utf8";
            try {
                $this->pdo_inserCarte = new PDO($bdd, "root", "");
                $this->pdo_inserCarte->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Échec de la connexion : " . $e->getMessage());
            }
        }
    }

    public function insertCarte($images){
        $sql = "INSERT INTO memory_game (image1, image2) VALUES (:image1, :image2)";
        $stmt = $this->pdo_inserCarte->prepare($sql);

        foreach ($images as $image) {
            if (file_exists($image)) {
                $imagedata = file_get_contents($image);

                if ($imagedata === false) {
                    echo "Erreur lors de la lecture du fichier : $image\n";
                    continue;
                }

                try {
                    $stmt->bindParam(':image1', $imagedata, PDO::PARAM_LOB);
                    $stmt->bindParam(':image2', $imagedata, PDO::PARAM_LOB);

                    $stmt->execute();
                    echo "Image insérée avec succès : $image\n";
                } catch (PDOException $e) {
                    echo "Erreur lors de l'insertion de l'image : " . $e->getMessage() . "\n";
                }
            } else {
                echo "Le fichier n'existe pas : $image\n";
            }
        }
    }

    public function getImages($ids) {
        $ids = array_map('intval', $ids);

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT id, image1, image2 FROM memory_game WHERE id IN ($placeholders)";
        $stmt = $this->pdo_inserCarte->prepare($sql);
        $stmt->execute($ids);

        $images = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $images[$row['id']] = [
                'image1' => $row['image1'],
                'image2' => $row['image2']
            ];
        }
        return $images;
    }
}
?>

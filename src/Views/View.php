<?php
namespace App\Views;

class View {
    public function render($viewName, $data = []) {
        // Convertir les données en variables
        extract($data);

        // Démarrer un buffer pour capturer le contenu de la vue
        ob_start();

        // Inclure la vue spécifique
        include_once __DIR__ . "/templates/$viewName.php";

        // Récupérer le contenu de la vue
        $content = ob_get_clean();

        // Inclure le gabarit principal, en passant le contenu capturé
        include_once __DIR__ . "/templates/_gabarit.php";
    }
}
<?php

require_once __DIR__ . '/../../src/Utils/Autoloader.php';

use App\Utils\Autoloader;
use App\Controlleur\GererQuizz;

Autoloader::register();

$action = $_GET['action'] ?? 'quiz';

if ($action === 'quiz') { 
    GererQuizz::leQuizz();

} elseif ($action === 'check') {
    try {
        GererQuizz::lesReponses();
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }

} elseif ($action === 'results') {
    GererQuizz::leResultat();

} elseif ($action === 'upload') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();

        if (isset($_FILES['quizFile'], $_POST['username'])) {
            $fichier = $_FILES['quizFile'];

            // Vérification du fichier JSON
            if ($fichier['type'] === 'application/json' && $fichier['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/quizz/';
                if (!is_dir($uploadDir)) { // Création du répertoire si nécessaire
                    if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                        die("Échec de la création du répertoire $uploadDir");
                    }
                }

                // Déplacement du fichier téléchargé
                $filePath = $uploadDir . basename($fichier['name']);
                if (move_uploaded_file($fichier['tmp_name'], $filePath)) {
                    $_SESSION['username'] = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
                    $_SESSION['quizFile'] = $filePath;

                    // Redirection vers l'action quiz
                    header('Location: gerer_fichier.php?action=quiz');
                    exit;
                } else {
                    echo "Erreur lors du téléchargement du fichier.";
                }
            } else {
                echo "Veuillez fournir un fichier JSON valide comme indiqué dans le README.";
            }
        } else {
            echo "Veuillez fournir un fichier JSON et un nom d'utilisateur.";
        }
    } else {
        echo "Méthode de requête non autorisée.";
    }
} else {
    echo "Action inconnue.";
}

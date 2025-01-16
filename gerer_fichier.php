<?php

require "GererQuizz.php";

$action = $_GET['action'] ?? 'quiz';

if ($action === 'quiz' ) { 
        GererQuizz::leQuizz();

} elseif ($action === 'check' ) {
        GererQuizz::lesReponses();

} elseif ($action === 'results' ) {
        GererQuizz::leResultat();

} elseif ($action === 'upload' ) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            if (isset($_FILES['quizFile'], $_POST['username'])) {
                $fichier = $_FILES['quizFile'];

                if ($fichier['type'] === 'application/json' && $fichier['error'] === UPLOAD_ERR_OK) { // Verifier que le fichier est bien un Json
                    $uploadDir = __DIR__.'quizz/';
                    if (!is_dir($uploadDir)) { //Creer le sous dossier et le fichier si besoin
                        mkdir($uploadDir, 0777, true);
                    }

                    $filePath = $uploadDir.basename($fichier['name']);
                    move_uploaded_file($fichier['tmp_name'], $filePath);

                    $_SESSION['username'] = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
                    $_SESSION['quizFile'] = $filePath;

                    header('Location: gerer_fichier.php?action=quiz');
                    exit;
                } else {
                    echo "Veuillez fournir un Json comme dans le README.";
                }
            } else {
                echo "Veuillez fournir un Json comme dans le README.";
            }
        } else {
            echo "Pas bon fichier";
        }

}

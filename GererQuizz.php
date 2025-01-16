<?php

require "Quizz.php"; 
require "ChargerJson.php";
require "Question.php";
require "Score.php";


class GererQuizz {
    public static function leQuizz() {
        session_start();
    
        if (!isset($_SESSION['quizFile'])) {
            echo "Choisissez un fichier";
            exit;
        }


        $filePath = $_SESSION['quizFile'];
        $data = ChargerJson::charger($filePath);
        ChargerJson::valider($data);
        $quizz = new Quizz($data['title'], []);
        
        if ($quizz === null) {
            throw new Exception("Quiz introuvable !");
        }

        foreach ($data['questions'] as $question) {
            $quizz->addQuestion(new Question($question['text'], $question['choices'], $question['answer']));
        }
        require __DIR__.'/templates/quizz.php'; 
    }
    
    public static function lesReponses() {
        session_start();
    
        //$reponse = $_POST['answers'] ?? [];
        //if (empty($reponse)) {
        //    throw new RuntimeException("Aucune réponse n'a été soumise.");
        //}
    
        if (!isset($_SESSION['quizFile']) || empty($_SESSION['quizFile'])) {
            throw new RuntimeException("Le fichier du quiz n'est pas défini.");
        }
        if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
            throw new RuntimeException("Le nom d'utilisateur n'est pas défini.");
        }

        $filePath = $_SESSION['quizFile'];
        $data = ChargerJson::charger($filePath);
    
        // Recup bonne reponse
        $bonneReponse = array_map(fn($question) => $question['answer'], $data['questions']);
    
        // Le score
        $score = 0;
        $nbQuestion = 0;
        foreach ($reponse as $index => $reponse) {
            $nbQuestion++;
            if ($reponse === $bonneReponse[$index]) {
                $score++;
            }
        }
    
        $pdo = BD::connection();
        $stmt = $pdo->query("SELECT MAX(idJ) AS max_id FROM SCORE");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $result['max_id'] !== null ? (int)$result['max_id'] + 1 : 1;

        $_SESSION['score'] = $score;
        $_SESSION['nbquestions'] = $nbQuestion;
        Score::sauverLeScore($maxId, $_SESSION['username'], $score);

        header('Location: gerer_fichier.php?action=results');
        exit;
    }
    
    public static function leResultat() {
        require __DIR__ . '/templates/resultat.php';
    }
    
}

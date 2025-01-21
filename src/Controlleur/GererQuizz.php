<?php


namespace App\Controlleur;

use App\Modele\Quizz;
use App\Modele\Question;
use App\Providers\ChargerJson;
use App\Utils\Score;


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
        require __DIR__.'/../../templates/quizz.php'; 
    }
    
    public static function lesReponses() {
        session_start();

        $answers = $_POST['answers'] ?? [];

        $filePath = $_SESSION['quizFile'];
        $data = ChargerJson::charger($filePath);
        $correctAnswers = array_map(fn($q) => $q['answer'], $data['questions']);

        $score = 0;
        $nbq = 0;
        foreach ($answers as $index => $answer) {
            $nbq++;
            if ($answer === $correctAnswers[$index]) {
                $score++;
            }
        }

        $_SESSION['score'] = $score;
        $_SESSION['nbquestions'] = $nbq;

        // Enregistrement dans la base de données
        $randomNumber = rand(1, 100000000000);
        Score::sauverLeScore($randomNumber, $_SESSION['username'], $score);

        header('Location: gerer_fichier.php?action=results');
        exit;
    }
    
    public static function leResultat() {
        require __DIR__ . '/../../templates/resultat.php';
    }
    
}

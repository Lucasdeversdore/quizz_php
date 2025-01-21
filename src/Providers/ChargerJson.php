<?php

namespace App\Providers;

class ChargerJson {
    public static function charger(string $filepath): array {
        if (!file_exists($filepath)) {
            throw new \Exception("$filepath existe pas");
        }
        
        $data = json_decode(file_get_contents($filepath), true);
        if (empty($data)) {
            throw new \Exception(sprintf('Vide'));
        }
        else {
            return $data;
        }
    }
    
    public static function valider($data) {
        if (!isset($data['title'], $data['questions'])) {
            throw new Exception("Fichier Json pas fait correctement, veuillez regarder le README");
        }
        foreach ($data['questions'] as $question) {
            if (!isset($question['text'], $question['choices'], $question['answer'])) {
                throw new Exception("Fichier Json pas fait correctement, veuillez regarder le README");
            }
        }
        return true;
    }
}

<?php

require 'BD.php';

class Score {
    public static function sauverLeScore(int $idJoueur, string $nomJoueur, int $score): void {
        try {
            // Connexion à la base de données
            $pdo = BD::connection();

            // Préparer et exécuter la requête d'insertion
            $query = "INSERT INTO SCORE (idJ, nomJ, score) VALUES (:idJ, :nomJ, :score)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':idJ' => $idJoueur,
                ':nomJ' => $nomJoueur,
                ':score' => $score
            ]);
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de l'enregistrement du score : " . $e->getMessage());
        }
    }
}

?>

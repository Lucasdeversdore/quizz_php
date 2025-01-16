<?php

class Quizz {
    private string $titre;
    private array $lesQuestions;

    public function __construct(string $titre, array $question = []) {
        $this->titre = $titre;
        $this->lesQuestions = $question;
    }

    public function addQuestion(Question $question): void {
        $this->lesQuestions[] = $question;
    }
    
    public function getTitre(): string {
        return $this->titre;
    }

    public function getLesQuestions(): array {
        return $this->lesQuestions;
    }
}
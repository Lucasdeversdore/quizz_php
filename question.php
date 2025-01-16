<?php

class Question {
    private string $texte;
    private array $choix;
    private string $bonneRep;

    public function __construct(string $texte, array $choix, string $bonneRep) {
        $this->texte = $texte;
        $this->choix = $choix;
        $this->bonneRep = $bonneRep;
    }

    public function getTexte(): string {
        return $this->texte;
    }

    public function getChoix(): array {
        return $this->choix;
    }

    public function estCorrect(string $bonneRep): bool {
        return $this->bonneRep === $bonneRep;
    }
}
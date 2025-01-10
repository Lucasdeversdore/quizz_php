<?php
Function getQuizz(): array|Exception{
    $source = '../data/data.json';
    $content = file_get_contents($source);
    $quizz = json_decode($content, true);

    if(empty($quizz)){
        throw new Exception('No quizz');
    }

    return $quizz;
}


?>
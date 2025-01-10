<?php
spl_autoload_register(static function(string $fqcn) {
    // $fqcn contient Model\Thread\Message par exemple
    // remplaçons les \ par des / et ajoutons .php à la fin.
    // on obtient Model/Thread/Message.php
    $path = str_replace('\\', '/', $fqcn).'.php';
 
    // puis chargeons le fichier
    require_once('classes/'.$path);
 });
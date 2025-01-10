<?php
declare(strict_types=1);

include "load.php";

use \site\type\Text;

$test = new Text(" test ");

echo $test->render();
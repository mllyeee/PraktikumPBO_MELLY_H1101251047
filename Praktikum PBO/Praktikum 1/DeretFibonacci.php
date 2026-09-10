<?php

$a = 2;
$b = 3;

for ($i = 1; $i <= 10; $i++) {
    echo $a . " ";

    $c = $a + $b;
    $a = $b;
    $b = $c;
}

?>
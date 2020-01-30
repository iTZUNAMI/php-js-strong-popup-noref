<?php

$s="20:00";
$now= date("H:i", time());

if ($now>$s)
    echo $now." > ".$s;
else
    echo $now." < ".$s;


?>
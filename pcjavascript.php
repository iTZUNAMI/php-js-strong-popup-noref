<?php

include ("site.config.php");

$check=issetor($_REQUEST["c"]);//1
$sito_id_origine=issetor($_REQUEST["s"]); //0-n
$sito_id_cpm_destinazione=issetor($_REQUEST["d"]); //0-n

if ($check==NULL || $sito_id_origine==NULL || $sito_id_cpm_destinazione==NULL){exit;}

  aggiorna($oggi,$sito_id_origine,$sito_id_cpm_destinazione);
  redir($sito_id_cpm_destinazione,$sito_cpm);
  exit;
  
?>
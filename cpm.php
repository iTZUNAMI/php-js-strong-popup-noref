<?php

/* siti provenienza */

$sito_origine[0]="dom1.com";
$sito_origine[1]="dom2.com";
$sito_origine[2]="dom3.com";
$sito_origine[3]="network it";
$sito_origine[4]="network eu";


/* siti campagne CPM personali 0-9 */
$cpmid=0;
$sito_cpm[$cpmid]['macro']="Personali";
$sito_cpm[$cpmid]['url']="http://www.scimmiablu.altervista.org"; 	
$sito_cpm[$cpmid]['limite']='3400';

$cpmid=1;
$sito_cpm[$cpmid]['macro']="Personali";
$sito_cpm[$cpmid]['url']="http://tokken.altervista.org"; 		
$sito_cpm[$cpmid]['limite']='2500';

$cpmid=2;
$sito_cpm[$cpmid]['macro']="Personali";
$sito_cpm[$cpmid]['url']="http://www.tuodom.it/landing.html";
$sito_cpm[$cpmid]['limite']='7000';

$cpmid=3;
$sito_cpm[$cpmid]['macro']="Personali";
$sito_cpm[$cpmid]['url']="http://uptiki.altervista.org";
$sito_cpm[$cpmid]['limite']='2000';

$cpmid=4;
$sito_cpm[$cpmid]['macro']="Personali";
$sito_cpm[$cpmid]['url']="http://tuodom.eu";
$sito_cpm[$cpmid]['limite']='700';

$cpmid=5;
$sito_cpm[$cpmid]['macro']="Personali";
$sito_cpm[$cpmid]['url']="http://www.tuodom.com";
$sito_cpm[$cpmid]['limite']='0';

$cpmid=6;
$sito_cpm[$cpmid]['macro']="Personali";
$sito_cpm[$cpmid]['url']="http://tuodom.eu.ourtoolbar.com/";
$sito_cpm[$cpmid]['limite']='3000';

$mylimiteinf=0;
$mylimitesup=11;




/* siti campagne CPM a pagamento 20-99 */

//// SNAI
$cpmid=20;
$sito_cpm[$cpmid]['macro']="SNAI";
$sito_cpm[$cpmid]['url']="http://tracking.tuodom.it/snai/";
$sito_cpm[$cpmid]['limite']='350';
$sito_cpm[$cpmid]['orario_start']='18:00';




// TOSHIBA 30-17

$cpmid=30;
$sito_cpm[$cpmid]['macro']="TOSHIBA";
$sito_cpm[$cpmid]['url']="http://tracking.tuodom.it/toshiba/display-300x250/"; 		
$sito_cpm[$cpmid]['limite']='210';

$cpmid=31;
$sito_cpm[$cpmid]['macro']="TOSHIBA";
$sito_cpm[$cpmid]['url']="http://tracking.tuodom.it/toshiba/display-728x90/"; 		
$sito_cpm[$cpmid]['limite']='110';




$limiteinf=19;
$limitesup=100;


?>
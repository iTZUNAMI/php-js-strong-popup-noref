<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

include ("site.config.php");

$sito_id_origine=$_REQUEST["s"]; //0-n

if ($sito_id_origine==NULL) exit;


/*pagamento*/
$sito_cpm_id=$limiteinf;
while($sito_cpm_id != $limitesup)
{
    if ( (isset($sito_cpm[$sito_cpm_id]['url'])) && 
          checkOrario($sito_cpm_id,$sito_cpm)   &&
         (pop_cpm($oggi,$sito_id_origine,$sito_cpm_id)) < $sito_cpm[$sito_cpm_id]['limite'])
         {  
            redir_js($sito_cpm_id,$sito_id_origine,$baseurl,$cookieSetting);
            exit;
         }
   $sito_cpm_id++;
}




/*my*/
$sito_cpm_id=$mylimiteinf;
while($sito_cpm_id != $mylimitesup)
{
    if ( (isset($sito_cpm[$sito_cpm_id]['url'])) && 
          checkOrario($sito_cpm_id,$sito_cpm)   &&
         (pop_cpm($oggi,$sito_id_origine,$sito_cpm_id)) < $sito_cpm[$sito_cpm_id]['limite'])
         {  
            redir_js($sito_cpm_id,$sito_id_origine,$baseurl,$cookieSetting);
            exit;
         }
   $sito_cpm_id++;
}






?>
<?php
require_once 'database.php';
//require_once 'db.php';
include 'cpm.php';

//settings
$baseurl="http://scimmiablu.altervista.org/cpm/v2/";
$oggi = date('Y-m-d');

$cookieSetting['nome']="CPM";
$cookieSetting['expire']=1 * 24 * 3600 * 1000; //ogni 24h
$cookieSetting['path']="/";


//template 
include("template/header.php");
include("template/footer.php");

$p=issetor($_REQUEST["p"],0);


//funzioni generali

function issetor(&$variable, $or = NULL) {
    return $variable === NULL ? $or : $variable;
}


function redir($id,$sito_cpm)
{
header('Location: '.$sito_cpm[$id]['url'].'');
}


function checkoggi($oggi,$sito_id_origine,$sito_id_destinazione)
{       
        $db = new DataBase();
	$q="SELECT ladata FROM my_cpm WHERE ladata='$oggi' AND sito_id_origine='$sito_id_origine' AND sito_id_destinazione='$sito_id_destinazione'";
        $righe = $db->NumRows($q);
        
	if ($righe==0){   
	$q2="INSERT INTO my_cpm (ladata,sito_id_origine,sito_id_destinazione,popup) VALUES ('$oggi','$sito_id_origine','$sito_id_destinazione','0')";
        $db->Query($q2);
        return true;
	}
        
        return false;
}

function checkOrario($sito_cpm_id,$sito_cpm){
    $now=date("H:i", time()); //ES 18:00
    
    if (isset($sito_cpm[$sito_cpm_id]['orario_start']))
    {
        //se esiste anche una fine
        if (isset($sito_cpm[$sito_cpm_id]['orario_end']))
        {
            //se nell'intervallo
            if ($now >= $sito_cpm[$sito_cpm_id]['orario_start'] && $now <= $sito_cpm[$sito_cpm_id]['orario_end'])
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        //altrimenti solo dalle ore XX:XX fino a 00:00 di default
        else {
            if ($now >= $sito_cpm[$sito_cpm_id]['orario_start'])
                {
                    return true;
                }
            else
                {
                    return false;
                }   
        }
        //altrimeni nessun invio
        return false;
    }
    
    //se nessuna limite specificato sempre true
    return true;

    
}



function redir_js($sito_cpm_id,$sito_id_origine, $baseurl,$cookieSetting) {
    
   Header("content-type: application/x-javascript");
   ob_start("ob_gzhandler"); 

?>

function addEvent(obj, eventName, func){if (obj.attachEvent){obj.attachEvent("on" + eventName, func);}else if(obj.addEventListener){obj.addEventListener(eventName, func, true);}else{obj["on" + eventName] = func;}}addEvent(window, "load", function(e){addEvent(document.body, "click", function(e){var params = 'height='+screen.height+',width=' + screen.width + ',left=0,top=0,location=1,toolbar=1,status=1,menubar=1,scrollbars=1,resizable=1';
if(document.cookie.indexOf("<?php echo $cookieSetting['nome'];?>") == -1){
var ExpireDate = new Date ();ExpireDate.setTime(ExpireDate.getTime() + (<?php echo $cookieSetting['expire'];?>));document.cookie = "popunder=<?php echo $cookieSetting['nome'];?>" + ";expires=" + ExpireDate.toGMTString()+ ";path=<?php echo $cookieSetting['path'];?>";;
var w2 = window.open("<?php echo $baseurl."pcjavascript.php?c=1&s=".$sito_id_origine."&d=".$sito_cpm_id;?>",'<?php echo $cookieSetting['nome'];?>', params);
if (w2){ 
document.cookie = "popunder=<?php echo $cookieSetting['nome'];?>" + "; expires=" + ExpireDate.toGMTString()+ ";path=<?php echo $cookieSetting['path'];?>";w2.blur();
}}});});



<?php
}




function  pop_cpm($oggi,$sito_id_origine,$sito_id_dest)
{
        $db = new DataBase();  
        $init=checkoggi($oggi,$sito_id_origine,$sito_id_dest);
        if ($init==true) {return 0;}//quindi invio pop
        else{
	$q="SELECT SUM(popup) AS SPOP FROM my_cpm WHERE ladata='$oggi' AND sito_id_destinazione='$sito_id_dest'";
        $n_pop=$db->GetRow($q,"SPOP");
	return $n_pop;
        }
}


function aggiorna($oggi,$sito_id_origine,$sito_id_dest)
{       
        $db = new DataBase(); 
	$q="SELECT popup FROM my_cpm WHERE ladata='$oggi' AND sito_id_origine='$sito_id_origine' AND sito_id_destinazione='$sito_id_dest'";
        $n_pop=$db->GetRow($q,"popup");
	$n_pop++;
	$q2="UPDATE my_cpm SET popup='$n_pop' WHERE  ladata='$oggi' AND sito_id_origine='$sito_id_origine' AND sito_id_destinazione='$sito_id_dest'";
        $db->Query($q2);

}






?>
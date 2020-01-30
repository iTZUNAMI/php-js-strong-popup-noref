<?
include ("db.php");

$header='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestione CPM</title>
<style type="text/css">
<!--
@import url("style.css");
-->
</style>
</head>
<body>
<h1>Gestione CPM</h1>
';
$footer='
</body>
</html>';


function issetor(&$variable, $or = NULL) {
    return $variable === NULL ? $or : $variable;
}

$path="http://scimmiablu.altervista.org/cpm/ang.php";

$view=issetor($_REQUEST["v"]);
$g=issetor($_REQUEST["g"]);
$p=issetor($_REQUEST["p"],0);

$c=issetor($_REQUEST["c"],0);
$id2=issetor($_REQUEST["id2"]);

/***********************************************************************************/
/*impostazioni*/
/***********************************************************************************/

/* sito sorgente che si visualizza nelle statistiche */
$sito_or[0]="miosito.it";



/* url sito destinazione e max popup giornalieri (24h) che vengono contati all'apertura */

$sito_cpm[999][0]="http://scimmiablu.altervista.org"; 
$sito_cpm[999][1]='50';

/***********************************************************************************/
/***********************************************************************************/




/* script by mAz */




$oggi = date('Y-m-d');

if ($c==1){
    
  aggiorna($oggi,0,$id2);
  redir($id2,$sito_cpm);
  exit;
    
}

if ($view=="stat"){

echo $header;

if ($g==null) $g=$oggi;


vistaball($g,$sito_cpm,$sito_or,$p);


echo $footer;
exit;
}

checkoggi($oggi,0,999);


$id=999;
$pop_inviati_cpm=pop_cpm($oggi,-1,$id);
if ($pop_inviati_cpm <= $sito_cpm[$id][1])
{
checkoggi($oggi,0,$id);
redir_js($id,$sito_cpm,$path);
exit;
}


function redir($id,$sito_cpm)
{
header('Location: '.$sito_cpm[$id][0].'');
}


function redir_js($id,$sito_cpm,$path)
{
    
Header("content-type: application/x-javascript");
ob_start("ob_gzhandler"); 


echo'
function adv() {
 document.write("'.$var.'");}';
?>

function addEvent(obj, eventName, func){if (obj.attachEvent){obj.attachEvent("on" + eventName, func);}else if(obj.addEventListener){obj.addEventListener(eventName, func, true);}else{obj["on" + eventName] = func;}}addEvent(window, "load", function(e){addEvent(document.body, "click", function(e){/* -------------- cau hinh chung cho cu so  --------------------*/var params = 'height='+screen.height+',width=' + screen.width + ',left=0,top=0,location=1,toolbar=1,status=1,menubar=1,scrollbars=1,resizable=1';
if(document.cookie.indexOf("scimmia") == -1){
var ExpireDate = new Date ();ExpireDate.setTime(ExpireDate.getTime() + (1 * 24 * 3600 * 1000));document.cookie = "popunder=scimmia" + ";expires=" + ExpireDate.toGMTString()+ ";path=/";;
var w2 = window.open("<? echo $path; ?>?c=1&id2=<?php echo $id;?>",'scimmia', params);
if (w2){ 
document.cookie = "popunder=scimmia" + "; expires=" + ExpireDate.toGMTString()+ ";path=/";w2.blur();
}
}}
);});

<?
}



function  pop_cpm($oggi,$sito_id_origine,$sito_id_dest)
{

if ($sito_id_origine==-1)
{
	$q="SELECT SUM(pop) FROM aggiorna WHERE ladata='$oggi' AND webdest='$sito_id_dest'";
	$sql=mysql_query($q) or die(" err " . $q . "<br /> Error: (" . mysql_errno() . ") " . mysql_error());

	
	$row=mysql_fetch_row($sql);
	
	$n_pop=$row[0];
	return $n_pop;
}
else{

	$q="SELECT pop FROM aggiorna WHERE ladata='$oggi' AND websource='$sito_id_origine' AND webdest='$sito_id_dest'";
	$sql=mysql_query($q) or die(" err " . $q . "<br /> Error: (" . mysql_errno() . ") " . mysql_error());

	
	$row=mysql_fetch_row($sql);
	
	$n_pop=$row[0];
	return $n_pop;
	}
}

// aggiunge +1
function aggiorna($oggi,$sito_id_origine,$sito_id_dest)
{


	$q="SELECT pop FROM aggiorna WHERE ladata='$oggi' AND websource='$sito_id_origine' AND webdest='$sito_id_dest'";
	$sql=mysql_query($q) or die(" err " . $q . "<br /> Error: (" . mysql_errno() . ") " . mysql_error());
	$row=mysql_fetch_row($sql);
	
	$n_pop=$row[0];
	$n_pop++;
	
	$q2="UPDATE aggiorna SET pop='$n_pop' WHERE  ladata='$oggi' AND websource='$sito_id_origine' AND webdest='$sito_id_dest'";
	$sql_ins=mysql_query($q2) or die(" err " . $q2 . "<br /> Error: (" . mysql_errno() . ") " . mysql_error());;

}
// controllo giorno e creazione
function checkoggi($oggi,$sito_id_origine,$sito_id_dest)
{
	$q="SELECT ladata FROM aggiorna WHERE ladata='$oggi' AND websource='$sito_id_origine' AND webdest='$sito_id_dest'";
	$sql=mysql_query($q) or die(" err " . $q . "<br /> Error: (" . mysql_errno() . ") " . mysql_error());
	$righe = mysql_num_rows($sql);
	
	if ($righe==0){
	$q2="INSERT INTO aggiorna (ladata,websource,webdest,pop) VALUES ('$oggi','$sito_id_origine','$sito_id_dest','0')";
	$sql_ins=mysql_query($q2) or die(" err " . $q2 . "<br /> Error: (" . mysql_errno() . ") " . mysql_error());;
	
	}
}



function vistaball($oggi,$sito_cpm,$sito_or,$p)
{

	$q="SELECT * FROM aggiorna WHERE ladata='$oggi' ORDER BY webdest ASC";
	$sql=mysql_query($q) or die(" err " . $q . "<br /> Error: (" . mysql_errno() . ") " . mysql_error());
	$righe = mysql_num_rows($sql);
	if ($righe==0) { echo "nessun dato";}
	
	?>
		<table id="hor-minimalist-b" summary="Employee Pay Sheet">
    <thead>
    	<tr>
        	<th scope="col">Giorno</th>
            <th scope="col">Sito Origine</th>
            <th scope="col">Sito Destinazione</th>
            <th scope="col">Pop Inviati</th>
			<th scope="col">Limite</th>
        </tr>
    </thead>
    <tbody>
	<?
	while ($row=mysql_fetch_array($sql))
	{
	?>

    	<tr>
        	<td><? echo $row['ladata']; ?></td>
            <td><? echo $sito_or[$row['websource']]; ?></td>
            <td><? echo $sito_cpm[$row['webdest']][0]; ?></td>
            <td><? echo $row['pop']; ?></td>
			<td><? echo $sito_cpm[$row['webdest']][1]; ?></td>
        </tr>
       

	<?
	}
	?>
	    </tbody>
	</table>
	Seleziona il giorno:
	<? $pind=$p-1; 
	?>
	<a href="<? echo $path;?>?v=stat&p=<?echo $pind;?>&g=<? echo date("Y-m-d",strtotime("+$pind day"));?>">Indietro</a>
	<? $pava=$p+1; ?>
	<a href="<? echo $path;?>?v=stat&p=<?echo $pava;?>&g=<? echo date("Y-m-d",strtotime("+$pava day"));?>">Avanti</a>
	<?
	
	
}


?>
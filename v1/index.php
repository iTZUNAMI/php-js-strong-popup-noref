<?
include ("db.php");
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);


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


$sito_id_origine=$_REQUEST["s"]; //0-n
$sito_id_dest=$_REQUEST["d"]; //0-n
$forza_dest=$_REQUEST["f"]; // 0 off 1 on

$view=issetor($_REQUEST["v"]);
$g=issetor($_REQUEST["g"]);
$p=issetor($_REQUEST["p"],0);

/* siti sorgenti */
$sito_or[0]="fir";
$sito_or[1]="ci";
$sito_or[2]="upt";
$sito_or[3]="n";
$sito_or[4]="";


/* siti url campagne e max pop day*/
// sempre attive 
$sito_cpm[0][0]="http://scimmiablu.altervista.org"; 	$sito_cpm[0][1]='3400';
$sito_cpm[1][0]="http://tokken.altervista.org"; 		$sito_cpm[1][1]='2500';

//extra
$sito_cpm[2][0]="http://www./landing.html"; 				$sito_cpm[2][1]='7000';
$sito_cpm[3][0]="http://u"; 		$sito_cpm[3][1]='2000';
$sito_cpm[4][0]="http://ninj"; 			$sito_cpm[4][1]='700';
$sito_cpm[5][0]="http://www."; 				$sito_cpm[5][1]='0';
$sito_cpm[6][0]="http://il.ourtoolbar.com/"; $sito_cpm[6][1]='100000';






// pagamento

//SNAI 10

//
//$sito_cpm[10][0]="http://tuodom.com/snai/";
//$sito_cpm[10][1]='0';

// TOSHIBA 11-17

$sito_cpm[11][0]="http://tuodom.com/toshiba/display-300x250/"; 		
$sito_cpm[11][1]='210';

$sito_cpm[12][0]="http://tuodom.com/toshiba/display-728x90/"; 		
$sito_cpm[12][1]='110';

$sito_cpm[13][0]="http://tuodom.com/toshiba/search-generico/"; 		
$sito_cpm[13][1]='410';

$sito_cpm[14][0]="http://tuodom.com/toshiba/search-z930/"; 		
$sito_cpm[14][1]='130';

$sito_cpm[15][0]="http://tuodom.com/toshiba/search-u920t/"; 		
$sito_cpm[15][1]='130';

$sito_cpm[16][0]="http://tuodom.com/toshiba/search-u840w/"; 		
$sito_cpm[16][1]='120';

$sito_cpm[17][0]="http://tuodom.com/toshiba/search-u940/"; 		
$sito_cpm[17][1]='40';



$limiteinf=10;
$limitesup=18;//+1


//script


$oggi = date('Y-m-d');



//view
if ($view=="stat"){

echo $header;

if ($g==null) $g=$oggi;


vistab($g,$sito_cpm,$sito_or,$p);




echo $footer;

}

//view
if ($view=="conta"){
header("Content-type: application/xml; charset=".$GLOBALS["charset"]);
print("<?php xml version=\"1.0\" encoding=\"ISO-8859-1\"?>");
?>
<rss version="2.0">
<channel>
<valore>
<?
echo pop_cpm($oggi,-1,3)+pop_cpm($oggi,-1,4);
?>
</valore>
</channel>
</rss>

<?
exit;
}

if ($view=="statall"){

echo $header;

if ($g==null) $g=$oggi;


vistaball($g,$sito_cpm,$sito_or,$p);


echo $footer;

}


if ($sito_id_origine==null || $sito_id_dest==null) exit;



checkoggi($oggi,$sito_id_origine,$sito_id_dest);





//pagamento *************************


$id=$limiteinf;
while($id < $limitesup)
{
    if ( $sito_cpm[$id][0]!=NULL && (pop_cpm($oggi,$sito_id_origine,$id)) <= $sito_cpm[$id][1] && $forza_dest==1){
    checkoggi($oggi,$sito_id_origine,$id);
    aggiorna($oggi,$sito_id_origine,$id);
    redir($id,$sito_cpm);
    exit;
    }
    
    $id++;
}








//tokken
$pop_inviati_cpm=pop_cpm($oggi,$sito_id_origine,1);
if ($pop_inviati_cpm <= $sito_cpm[1][1] && $forza_dest==1){
checkoggi($oggi,$sito_id_origine,1);aggiorna($oggi,$sito_id_origine,1);redir(1,$sito_cpm);
exit;}




//scimmia
$pop_inviati_cpm=pop_cpm($oggi,$sito_id_origine,0);
if ($pop_inviati_cpm <= $sito_cpm[0][1] && $forza_dest==1){
checkoggi($oggi,$sito_id_origine,0);aggiorna($oggi,$sito_id_origine,0);redir(0,$sito_cpm);
exit;} 




/*    --------------------     */





/*    ---- altrimenti fine campagn mando su network non altervista  */


//uptiki
$pop_inviati_cpm=pop_cpm($oggi,$sito_id_origine,3);
if ($pop_inviati_cpm <= $sito_cpm[3][1] ){
checkoggi($oggi,$sito_id_origine,3);aggiorna($oggi,$sito_id_origine,3);redir(3,$sito_cpm);
exit;} 

//ninja
$pop_inviati_cpm=pop_cpm($oggi,$sito_id_origine,4);
if ($pop_inviati_cpm <= $sito_cpm[4][1] ){
checkoggi($oggi,$sito_id_origine,4);aggiorna($oggi,$sito_id_origine,4);redir(4,$sito_cpm);
exit;} 



//zapdos
$pop_inviati_cpm=pop_cpm($oggi,$sito_id_origine,2);
if ($pop_inviati_cpm <= $sito_cpm[2][1] ){
checkoggi($oggi,$sito_id_origine,2);aggiorna($oggi,$sito_id_origine,2);redir(2,$sito_cpm);
exit;} 



//babbano
$pop_inviati_cpm=pop_cpm($oggi,$sito_id_origine,5);
if ($pop_inviati_cpm <= $sito_cpm[5][1] ){
checkoggi($oggi,$sito_id_origine,5);aggiorna($oggi,$sito_id_origine,5);redir(5,$sito_cpm);
exit;} 


//toolb

$pop_inviati_cpm=pop_cpm($oggi,$sito_id_origine,6);
if ($pop_inviati_cpm <= $sito_cpm[6][1] ){
checkoggi($oggi,$sito_id_origine,6);aggiorna($oggi,$sito_id_origine,6);redir(6,$sito_cpm);
exit;} 




/*    --------------------     */







function redir($id,$sito_cpm)
{
header('Location: '.$sito_cpm[$id][0].'');
//echo $sito_cpm[$id][0];
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









function vistab($oggi,$sito_cpm,$sito_or,$p)
{
//ultimo mio netwk
	$q="SELECT * FROM aggiorna WHERE 
   ladata='$oggi' AND webdest > 6

	";
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
			<th scope="col">Limite (Globale del sito di destinazione)</th>
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
	<a href="http://scimmiablu.altervista.org/cpm/index.php?v=stat&p=<?echo $pind;?>&g=<? echo date("Y-m-d",strtotime("+$pind day"));?>">Indietro</a>
	<? $pava=$p+1; ?>
	<a href="http://scimmiablu.altervista.org/cpm/index.php?v=stat&p=<?echo $pava;?>&g=<? echo date("Y-m-d",strtotime("+$pava day"));?>">Avanti</a>
	
	
	<?
	
	
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
	<a href="http://scimmiablu.altervista.org/cpm/index.php?v=statall&p=<?echo $pind;?>&g=<? echo date("Y-m-d",strtotime("+$pind day"));?>">Indietro</a>
	<? $pava=$p+1; ?>
	<a href="http://scimmiablu.altervista.org/cpm/index.php?v=statall&p=<?echo $pava;?>&g=<? echo date("Y-m-d",strtotime("+$pava day"));?>">Avanti</a>
	<?
	
	
}

























?>
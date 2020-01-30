<?php
require_once 'site.config.php';

$giorno=issetor($_REQUEST["g"],$oggi);

echo $header;
if ($giorno==NULL) {$giorno=$oggi;}

showAll($giorno,$sito_cpm,$sito_origine,$p,$baseurl);

echo $footer;




function showAll($oggi,$sito_cpm,$sito_or,$p,$baseurl)
{
        $db = new DataBase();  
	$q="SELECT * FROM my_cpm WHERE ladata='$oggi' ORDER BY sito_id_destinazione ASC";
	$righe = $db->NumRows($q);
	if ($righe==0) { echo "nessun dato";}
	
	?>
<table id="hor-minimalist-b" summary="Employee Pay Sheet">
    <thead>
    	<tr>
            <th scope="col">Giorno</th>
            <th scope="col">Sito Destinazione</th>
            <th scope="col">Sito Origine</th>
            <th scope="col">Pop Inviati</th>
            <th scope="col">Limite</th>
        </tr>
    </thead>
    <tbody>
	<?php
        $sql=$db->Query($q);
	while ($row=mysql_fetch_array($sql))
	{
	?>

    	<tr>
            <td><?php echo $row['ladata']; ?></td>
            <td><?php echo $sito_cpm[$row['sito_id_destinazione']]['url']; ?></td>
            <td><?php echo $sito_or[$row['sito_id_origine']]; ?></td>
            
            <td><?php echo $row['popup']; ?></td>
	    <td><?php echo $sito_cpm[$row['sito_id_destinazione']]['limite']; ?></td>
        </tr>
       

	<?php
	}
	?>
	    </tbody>
	</table>
	Seleziona il giorno:
	<?php $pind=$p-1; 
	?>
	<a href="<?php echo $baseurl;?>stats.php?v=statall&p=<?php echo $pind;?>&g=<?php echo date("Y-m-d",strtotime("+$pind day"));?>">Indietro</a>
	<? $pava=$p+1; ?>
	<a href="<?php echo $baseurl;?>stats.php?v=statall&p=<?php echo $pava;?>&g=<?php echo date("Y-m-d",strtotime("+$pava day"));?>">Avanti</a>
	<?php
	
	
}


?>
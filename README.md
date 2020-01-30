# php-js-strong-popup-noref
a very strong popup script that will bypass firefox and chrome blocks

## settings

$cpmid=XX;

$sito_cpm[$cpmid]['macro']="YOUR CPM NAME";

$sito_cpm[$cpmid]['url']="DESTINATION URL";

$sito_cpm[$cpmid]['limite']='3000';  // MAX TRAFFIC (popup opened and viewed/confirmed)


optional hours bound (min max)

$sito_cpm[$cpmid]['orario_start']='18:00';

$sito_cpm[$cpmid]['orario_end']='21:00';

## database
configure your db access

## installation
add this to your page
<script type="text/javascript" src="yourdomain.com/path/pjavascript.php?s=XX"></script>
XX = soruce


## daily stats
check stats.php

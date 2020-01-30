<?PHP 

// Settings
$cachedir = './cachefr/'; // Directory to cache files in (keep outside web root)
$cachetime = 60; // Seconds to cache files for
$cacheext = 'htm'; // Extension to give cached files (usually cache, htm, txt)



// Script
$page = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // Requested page
$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create

$ignore_page = false;
for ($i = 0; $i < count($ignore_list); $i++) {
$ignore_page = (strpos($page, $ignore_list[$i]) !== false) ? true : $ignore_page;
}

$cachefile_created = ((@file_exists($cachefile)) and ($ignore_page === false)) ? @filemtime($cachefile) : 0;
@clearstatcache();

// Show file from cache if still valid
if (time() - $cachetime < $cachefile_created) {

//ob_start('ob_gzhandler');
@readfile($cachefile);
//ob_end_flush();
exit();

}

// If we're still here, we need to generate a cache file

ob_start();

include("db.php");
$var="";
$result = mysql_query("SELECT * FROM wp_posts WHERE post_status='publish' and post_type='post' ORDER BY RAND() LIMIT 0,4");
$conta=1;
/*
$rr=rand(0,4);
if ($rr==0){
$url2="http://tuodom.com/shop/battlefield-3-eu/";
$imgurl2="http://tuodom.com/wp-content/uploads/Cover1-150x240.jpg";
$tit2="Battlefield 3 18.80 &#8364;";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url2."'; return true;\\\" href=\\\"".$url2."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl2."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit2)."</div></div></a>";

$url3="http://tuodom.com/shop/call-of-duty-modern-warfare-3/";
$imgurl3="http://tuodom.com/wp-content/uploads/Copertina-212x300.jpg";
$tit3="Call of Duty Modern Warfare 3 19.90 &#8364;";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url3."'; return true;\\\" href=\\\"".$url3."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl3."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit3)."</div></div></a>";

$var.="<br><br>";
}
if ($rr==1){

$url2="http://tuodom.com/shop/fifa-13/";
$imgurl2="http://tuodom.com/wp-content/uploads/fifa1.jpg";
$tit2="Fifa 13 29.99 &#8364;";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url2."'; return true;\\\" href=\\\"".$url2."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl2."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit2)."</div></div></a>";

$url3="http://tuodom.com/shop/assassins-creed-iii/";
$imgurl3="http://tuodom.com/wp-content/uploads/Assassin-s-Creed-3_PC_cover-150x240.jpg";
$tit3="Assassin Creed 3 24.90 &#8364;";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url3."'; return true;\\\" href=\\\"".$url3."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl3."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit3)."</div></div></a>";

$var.="<br><br>";
}
if ($rr==2){

$url2="http://tuodom.com/shop/xbox-live-gold-122-mesi/";
$imgurl2="http://tuodom.com/wp-content/uploads/xbox-live-12-2-bonsu-month-gold-150x240.jpg";
$tit2="XBOX LIVE 14 MESI 37.90 &#8364;";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url2."'; return true;\\\" href=\\\"".$url2."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl2."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit2)."</div></div></a>";

$url3="http://tuodom.com/shop/saints-row-the-third/";
$imgurl3="http://tuodom.com/wp-content/uploads/Saints-rowzzz-150x240.jpg";
$tit3="Saints Row 3 16.80 &#8364;";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url3."'; return true;\\\" href=\\\"".$url3."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl3."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit3)."</div></div></a>";

$var.="<br><br>";
}
if ($rr==3){

$url2="http://tuodom.com/shop/crysis-3/";
$imgurl2="http://tuodom.com/wp-content/uploads/ScreenShot057-150x240.jpg";
$tit2="Crysis 3 34.80 &#8364;";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url2."'; return true;\\\" href=\\\"".$url2."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl2."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit2)."</div></div></a>";

$url3="http://tuodom.com/shop/medal-of-honor-warfighter/";
$imgurl3="http://tuodom.com/wp-content/uploads/3max1-150x240.jpg";
$tit3="Medal of Honor Warfighter 34.90 &#8364;";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url3."'; return true;\\\" href=\\\"".$url3."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl3."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit3)."</div></div></a>";

$var.="<br><br>";
}
if ($rr==4){

$url2="http://tuodom.com/shop/call-of-duty-black-ops-2/";
$imgurl2="http://tuodom.com/wp-content/uploads/cod-black-ops-2-pc-212x300-150x240.jpg";
$tit2="Call of Duty Black Ops 2  24.90 &#8364;";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url2."'; return true;\\\" href=\\\"".$url2."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl2."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit2)."</div></div></a>";

$url3="http://tuodom.com/shop/farcry-3/";
$imgurl3="http://tuodom.com/wp-content/uploads/Far-Cry-3_PC_cover-150x240.jpg";
$tit3="Farcry 3 26.80 &#8364;";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url3."'; return true;\\\" href=\\\"".$url3."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl3."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit3)."</div></div></a>";

$var.="<br><br>";
}
*/
//zapdos
/* 
$url2="http://www.tuodom.com";
$imgurl2="http://www.tuodom.com/games/images/332541_super_mario_loves_mushrooms.jpg";
$tit2="Super Mario";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url2."'; return true;\\\" href=\\\"".$url2."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl2."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit2)."</div></div></a>";

$url3="http://www.tuodom.com";
$imgurl3="http://www.tuodom.com/games/images/2011-10-08_189_footballheadsmash.jpg";
$tit3="Heads Football";
$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url3."'; return true;\\\" href=\\\"".$url3."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://tuodom.com/adv/timthumb.php?src=".$imgurl3."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit3)."</div></div></a>";

$var.="<br><br>"; */



//$zap = file_get_contents("http://www.tuodom.com/adv/cachefr/aa6d13037c6f2971281ecc17d4159e1c.htm");
//$var.=$zap;

while($row = mysql_fetch_array($result)) {

$id=$row['ID'];
$tit=$row['post_title'];
$url=$row['guid'];
//img

$result2 = mysql_query("SELECT * FROM wp_posts WHERE post_parent='$id' and post_type='attachment' ORDER BY menu_order ASC LIMIT 0,1");


while($roww2 = mysql_fetch_array($result2)) {
 
$imgurl=$roww2['guid'];

$var.="<a rel=\\\"nofollow\\\" target=\\\"_blank\\\" onmouseout=\\\"this.style.backgroundColor=''\\\" onmouseover=\\\"this.style.backgroundColor='#000'\\\" style=\\\"display: block; float: left; border-bottom: medium none; margin: 0pt; padding: 9px; text-decoration: none; text-align: left; cursor: pointer;\\\" onmousedown=\\\"this.href='".$url."'; return true;\\\" href=\\\"".$url."\\\" name=\\\"linkwithin_link_0\\\"><div style=\\\"width: 76px; height: 145px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"><div style=\\\"margin: 0pt; border: 1px solid rgb(221, 221, 221); padding: 2px; width: auto; height: auto;\\\" class=\\\"linkwithin_img_0\\\"><div style=\\\"background: url(&quot;http://scimmiablu.altervista.org/wp-content/themes/daily/timthumb.php?src=".$imgurl."&quot;) no-repeat scroll 0% 0% transparent; width: 70px; height: 70px; margin: 0pt; border: 0pt none; padding: 0pt;\\\"></div></div><div style=\\\"margin: 3px 0pt 0pt; border: 0pt none; padding: 0pt; font: 11px arial; color: rgb(201, 201, 201);\\\" class=\\\"linkwithin_title linkwithin_title_0\\\">".addslashes($tit)."</div></div></a>";
if ($conta==2) $var.="<br><br>";
$conta++;
}

		
			
}
//OUTPUT
Header("content-type: application/x-javascript");
ob_start("ob_gzhandler"); 
echo'function adv() {document.write("'.$var.'");}';
?>
  var _pop = _pop || [];
  _pop.push(['siteId', 26916]);
  _pop.push(['minBid', 0.0007]);
  _pop.push(['popundersPerIP', 2]);
  _pop.push(['delayBetween', 0]);
  _pop.push(['default', false]);
  _pop.push(['defaultPerDay', 0]);
  _pop.push(['topmostLayer', false]);
  (function() {
    var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true;
    pa.src = 'http://world.popadscdn.net/pop.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(pa, s);
  })();
<?php

    $popUp=file_get_contents("http://scimmiablu.altervista.org/cpm/v2/pjavascript.php?s=3");
    echo $popUp;

// Now the script has run, generate a new cache file
$fp = @fopen($cachefile, 'w');
// save the contents of output buffer to the file
@fwrite($fp, ob_get_contents());
@fclose($fp);

ob_end_flush();

?>
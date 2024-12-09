<a href=javascript:void(0)  border:0px onclick="closepopup('popup')">fermer <br><br></a>
<?php
$acro=$_GET["acro"];

//GET VARIABLE AUF HACKS PRÜFEN

$acro=trim(htmlspecialchars($acro, ENT_QUOTES));
$acro=strtolower ($acro);
$bad= array("select", "from", "where", "drop", "replace", "update", "insert", "delete", "set");
$repl=  array("", "", "", "", "", "", "", "", "");
$acro= mysql_real_escape_string(str_replace($bad,$repl,$acro))  ;
//echo $acro;

//$acro="AT";
include_once("datenbank.php");

$sql="SELECT nom FROM parties WHERE acro='".$acro."'";
$sql2="SELECT nomar FROM parties WHERE acro='".$acro."'";
$sql3="SELECT web FROM parties WHERE acro='".$acro."'";
$sql4="SELECT facebook FROM parties WHERE acro='".$acro."'";

//echo "<center>" ;    
mysql_query('set character set utf8;');
$erg = mysql_query($sql, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
 echo "<b>$t<br>";
                     mysql_query('set character set utf8;');
 $erg = mysql_query($sql2, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
 echo "<font size=3>$t</font></b><br><center><img src=logos/$acro.jpg height=200px></center>";


 $erg = mysql_query($sql3, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
 if($t!="")
 {
 echo "<br><a href=$t target='_blank'>Site officiel sur internet</a>";
 }





 $erg = mysql_query($sql4, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
  if($t!="")
 {
 echo "<br><a href=$t target='_blank'>Site officiel sur facebook</a>";
}


 $sql="SELECT linkfra FROM parties WHERE acro='".$acro."'";
 $erg = mysql_query($sql, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
 if($t!="")
 {
 echo "<br> <a href=$t target='_blank'>Fiche du parti </a>";
 }

 $sql="SELECT linkar FROM parties WHERE acro='".$acro."'";
 $erg = mysql_query($sql, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
 if($t!="")
 {
 echo "<br><a href=$t target='_blank'>Fiche du parti (عربي) <br><br></a> ";
 }
//mysql_close($con);
?>
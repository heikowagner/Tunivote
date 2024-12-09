<a href=javascript:void(0)  border:0px onclick="closepopup('popup')">fermer <br><br></a>
<?php
$acro=$_GET["acro"];

$acro=trim(htmlspecialchars($acro, ENT_QUOTES));
$acro=strtolower ($acro);
$bad= array("select", "from", "where", "drop", "replace", "update", "insert", "delete", "set");
$repl=  array("", "", "", "", "", "", "", "", "");
$acro= str_replace(".$bad.",".$repl.",".$acro.")  ;


$qnumber=$_GET["qnumber"];
$qnumber=intval($qnumber);
//echo $acro;

//echo $qnumber;
include_once("datenbank.php");

$sql="SELECT `".$qnumber."` FROM respreas WHERE partie='".mysql_real_escape_string($acro)."'";
 mysql_query('set character set utf8;');

$erg = mysql_query($sql, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
 
 if ($t=="")
 {
 echo "Le parti \"$acro\" n'a pas présenté de justification sur la question nr. $qnumber:<br><br>$t";
 }
 else
 {
 echo "<b>Justification de la réponse du parti \"$acro\" à la question nr. $qnumber:</b><br><br>$t";
 }
 
//mysql_close($con);
?>
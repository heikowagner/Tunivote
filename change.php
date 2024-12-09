<?
include_once("datenbank.php");

//$arr= array(47,55,64,65,105,68,38,100,93,103,82,60,108,29,12,1,44,91,66,107,17,31,42,24,61,53,6,5,51,97,95,76,33,98,41,110,70,86,77,71,46,16,45,75,19,13,90,84,79,56,43,21,96,92,50,48,32,15,10);
$arr= array(65,62,27,30,88,100,60,108,12,29,1,44,91,66,17,107,31,24,42,61,53,6,5,51,97,95,33,76,41,98,70,110,86,46,71,77,16,45,13,19,75,21,43,56,79,84,90,10,15,32,48,50,92,96);             
//$arrgut= array(2,3,4,7,8,9,11,14,18,20,22,23,25,26,27,28,30,34,35,36,37,39,40,47,49,52,54,55,57,58,59,62,63,64,65,67,69,72,73,74,78,80,81,83,85,87,88,89,94,99,101,102,104,105,106,109)  ;
$arrgut= array(2,3,4,7,8,9,11,14,18,20,22,23,25,26,28,34,35,36,37,38,39,40,47,49,52,54,55,57,58,59,63,64,67,68,69,72,73,74,78,80,81,82,83,85,87,89,93,94,99,101,102,103,104,105,106,109)  ;

$arr2= "(65,62,27,30,88,100,60,108,12,29,1,44,91,66,17,107,31,24,42,61,53,6,5,51,97,95,33,76,41,98,70,110,86,46,71,77,16,45,13,19,75,21,43,56,79,84,90,10,15,32,48,50,92,96)";


$query = "delete from questions where id in ".$arr2."   ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());



$i=0   ;

while ($i<count($arrgut))
{
$neu= $i+1;
$query = "update questions set id=".$neu." where id=".$arrgut[$i]." ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());

$i++;
}




$i=0   ;

while ($i<count($arr))
{

$query = "ALTER TABLE `respreas` drop `".$arr[$i]."`  ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());

$i++;
}


$i=0   ;

while ($i<count($arr))
{

$query = "ALTER TABLE `responses` drop `".$arr[$i]."`  ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());

$i++;
}





$i=0   ;

while ($i<count($arrgut))
{
$neu= 1+$i;
$query = "ALTER TABLE `respreas` CHANGE `".$arrgut[$i]."` `".$neu."` text NULL DEFAULT NULL ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());

$i++;
}

$i=0;
while ($i<count($arrgut))
{
$neu= 1+$i;
$query = "ALTER TABLE `responses` CHANGE `".$arrgut[$i]."` `".$neu."` INT( 2 ) NULL DEFAULT NULL ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());

$i++;
}

               echo "done silmi";
?>
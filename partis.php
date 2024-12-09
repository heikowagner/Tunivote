<?
 session_start();
?>
<html>
<head>
   <link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
   <link rel="stylesheet" type="text/css" href="style.css">
 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   </head>

 <body>


   <?php
// Starting the session

$session =   session_id();

if(isset($_SESSION['partie']))
{
$partie=$_SESSION['partie'];
$password=$_SESSION['password'];

//echo $partie;
//echo $password;
}


if(!isset($_POST["partie"]) && !isset($_SESSION['partie'] ))
{

//ANMELDUNG

echo " <center><img src=img/tunivote.jpg>  </center><form action='partis.php' method='post'> Veuillez entrer votre login et mot de passe pour acc&eacute;der au questionnaire \"TuniVote\" consacr&eacute; aux partis <br>
 <table><br><tr><td>Login:</td><td><input type=\"text\" name='partie' /><br /> </td></tr><tr><td>Mot de passe: </td><td><input type=\"text\" name='password' /></td></tr></table>";
echo "<center><br><input type=\"submit\" name=\"login\" value=\"Login\"></center></form>";
}
else
{

if (!isset($_SESSION['partie']))
{
$partie=$_POST["partie"]      ;

$partie=trim(htmlspecialchars($partie, ENT_QUOTES));
$partie=strtolower ($partie);
$bad= array("select", "from", "where", "drop", "replace", "update", "insert", "delete", "set");
$repl=  array("", "", "", "", "", "", "", "", "");
$partie= str_replace($bad,$repl,$partie)  ;


$password=$_POST["password"]    ;
}

include_once("datenbank.php");




 $query = "select count('acro') from parties where acro='$partie' and password='$password' ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$t = $data[0] . "";
if ($t==0) {
echo "Your password is wrong";
                        exit() ;
}
else
{
$_SESSION['partie']=$partie  ;
$_SESSION['password']=$password  ;
}


?>



<?




$query = "select max(id) from questions";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$t = $data[0] . "";
$maxid = $t;


if (isset($_POST["button1"])) {
    $answer=1;

} elseif (isset($_POST["button2"])) {

    $answer=2;
} elseif (isset($_POST["button3"])) {

    $answer=3;
}
elseif (isset($_POST["button4"])) {

    $answer=4;
}




if (isset($_GET["qnumber"]) )
{
$qnumber =mysql_real_escape_string(intval(  $_GET["qnumber"] ));


 $qnumber1=$qnumber-1 ;

if (!isset($_GET["asw"]))
                          {
//$query = "delete from ".$session." where id=".$qnumber1." ";
//$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());

if (isset($answer))
  {

$query = "update responses set `$qnumber1`=$answer where `partie`='$partie' ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());

$reason=$_POST["reason"];
$sql="SET names 'utf8'";
mysql_query($sql);

 $query = "update respreas set `$qnumber1`='$reason' where `partie`='$partie' ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());


   }
                           }




//echo session_id();


}
else
{
$qnumber = 1;




}

if ($qnumber>$maxid)
{

//ABSCHLUSSBERICHT
echo "<center> <img src=img/tunivote.jpg>" ;
echo "<form action='send.php' method='post' ><font size=\"3\" > <b>V&eacute;rifiez vos r&eacute;ponses puis envoyez!</b></font><br>
<br><br>";


$i=0;

$query = "select * from responses where partie='$partie'";
mysql_query('set character set utf8;');

$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());


$data = mysql_fetch_row($erg)  ;


$query = "select * from respreas where partie='$partie'";
mysql_query('set character set utf8;');

$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());

echo "<table><tr><td></td><td><td></td></td><td><img src=yes.jpg> Pour<br><img src=no.jpg> Contre<br><img src=indiff.jpg> Neutre<br><br></td></tr><tr bgcolor=\"dddddd\"><td ><b>Nr</b></td><td><b>R&eacute;ponse</b></td><td><b>Question</b></td><td><b>Justification</b></td></tr></b>";
$awreason = mysql_fetch_row($erg)  ;


$i=0;
foreach ($data as $key => $value)
{


mysql_query('set character set utf8;');
$query = "select question from questions  where id= ".$i." ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data2 = mysql_fetch_row($erg);
$t = $data2[0] . "";
$question = $t;


if ($data[$i] == 1) {
    $symbol= "yes.jpg"    ;
} elseif ($data[$i] == 2) {
    $symbol= "indiff.jpg"    ;
} elseif ($data[$i] == 3) {
    $symbol= "no.jpg"    ;
}
elseif ($data[$i] == 4) {
    $symbol= "skip.jpg"    ;
}
elseif ($data[$i] == "") {
    $symbol= "skip.jpg"    ;
}

if ($i>0)
{
if ($i % 2 == 0) {
echo "<tr valign=\"top\" ><td><a href=\"partis.php?qnumber=$i\">$i</a></td><td align=\"center\"><img src=$symbol ></td><td bgcolor=\"eeeeee\" >$question</td><td bgcolor=\"eeeeee\">$awreason[$i]</td></tr>";
}
else
echo "<tr valign=\"top\"><td><a href=\"partis.php?qnumber=$i\">$i</a></td><td align=\"center\"><img src=$symbol ></td><td>$question</td><td>$awreason[$i]</td></tr>";
}

$i++;
$j=$i;

}
//echo "<tr><td>$j</td><td>$title2[$i] </td><td> $result[$i]</td></tr>";



echo "</table>  <center>
<br><b>Veuillez entrer votre Email pour vous envoyer une confirmation de vos r&eacute;ponses</b><input type=text name=email>
<br><input type=\"submit\" name=\"proceed\" value=\"Envoyer\">     </center>
</form>"    ;
}
else
{
mysql_query('set character set utf8;');
$query = "select question from questions  where id= ".$qnumber." ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$t = $data[0] . "";
$question = $t;

mysql_query('set character set utf8;');
$query = "select title from questions  where id= ".$qnumber." ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$t = $data[0] . "";
$title = $t;

mysql_query('set character set utf8;');
$query = "select questionar from questions  where id= ".$qnumber." ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$t = $data[0] . "";
$questionar = $t;


//HIER FRAGEN
echo "<center> <img src=img/tunivote.jpg>   
<font color=666666><br><br>Ch&#232;r responsable de parti,<br><br>vous &#234;tes le bienvenu sur l'interface de \"TuniVote\" consacr&eacute;e aux partis politiques participant aux &eacute;lections de la constituante.<br>
Veuillez r&eacute;pondre aux questions propos&eacute;es dans ce questionnaire. Sur chaque question vous pouvez entrer un commentaire justifiant <br>votre position (max. 500 charact&#232;res), avant d'appuyer sur le bouton correspondant:<br><br> </center></font>";

$qnumber2=$qnumber+1;
$width=300*$qnumber/$maxid;
$width2=300;
echo "<center><form action=\"partis.php?qnumber=$qnumber2\" method=\"post\"><font color=666666>Question $qnumber parmi $maxid:</font> <font color=FF3333>$title</font> <br><p><font color=555555><div id=balken style=\"width: ".$width."px ; height: 5px; background-color:black; \"></div><div id=balken style=\"width: ".$width2."px ; height: 5px; background-color:red; \"></div><br><b>$question</font></b></p>  <p><b><font color=555555 size=4>$questionar<br></font></b></p>";
?>
<br>

<table><br><tr><td><font color=666666>Vous pouvez entrer votre justification ici:</font></td><td><input type="text" name="reason" size="70" MAXLENGTH="500"></td></tr></table>
 <center>
<br>
<input type="submit" name="button1" value="Pour">
<input type="submit" name="button2" value="Neutre">
<input type="submit" name="button3" value="Contre">
<br>
<br>
</center>
 <?





 //Hier query für Surveystage
 $i=0;
 while ($i < $maxid)
 {

  $j=$i+1;
 
 mysql_query('set character set utf8;');
 
$query= " select `".$j."` from  responses where `partie`='$partie'";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$t = $data[0] . "";

$ende=0;


 if ($t != "")
 {

 echo " <a href=\"partis.php?qnumber=$j&asw=0\">$j</a> ";
 }
 else
 {
  echo " $j ";
  $ende++;
 }



 $i++;
 }
 
   $i++;
   if($ende==0)
   {
echo "<br><h4><a href= \"partis.php?qnumber=$i\">Aller &#224; la vue d'ensemble</a></h4></center> ";
}
echo "</center></form> ";
  }

  }?>
 
  </body>
  </html>
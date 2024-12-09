<?
 session_start();
?>

<head>
<title>TuniVote</title>
 <link type="image/x-icon" href="img/tunivote.ico" rel="shortcut icon">
   <link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
   <link rel="stylesheet" type="text/css" href="style.css">

<script type="text/javascript" src="functions.js"></script>

 <meta http-equiv="X-UA-Compatible" content="IE=edge" />

   </head>
<body>
<div id=links><ul><li><a href=index.php> Accueil </a></li><li><a href=aboutus.php> Qui sommes nous? </a></li><li><a href=about.php> À propos de TuniVote </a></li><li> <a href=guide.php> Guide d'utilisation </a></li><li> <a href=presse.php> Revue de presse </a></li><li> <a href=partner.php> Partenaires </a></li><li> <a href=team.php> L'équipe TuniVote </a></li><li> <a href="mailto:info@tunivote.net"> Contact </a></li>  </ul></div>      <br>

 

<br>  <br>  <br>

<?
function table_exists($tablename, $database = false) {

    if(!$database) {
        $res = mysql_query("SELECT DATABASE()");
        $database = mysql_result($res, 0);
    }

    $res = mysql_query("
        SELECT COUNT(*) AS count
        FROM information_schema.tables
        WHERE table_schema = '$database'
        AND table_name = '$tablename'
    ");

    return mysql_result($res, 0) == 1;

}
?>
<?php
function beginsWith($str, $sub) {
    return (strncmp($str, $sub, strlen($sub)) == 0);
}
?>

   <?php
// Starting the session


$session =   session_id();
//$_SESSION["session"]=$session  ;


?>



<?
include_once("datenbank.php");

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
$query = "delete from ".$session." where id=".$qnumber1." ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());


$query = "insert into ".$session." (id, answer) VALUES (".$qnumber1.", ".$answer." ) ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
                           }




//echo session_id();


}
else
{
$qnumber = 1;

  if (!table_exists($session))
    {
      $query = "CREATE TABLE ".$session." (ID int(2), answer int(2) )";
      $erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
    }


}

if ($qnumber>56) //HIER AUF 56 FRAGEN REDUZIERT !!!!!
{

//HIER ABSCHLUSSBERICHT

echo "<center> <img src=img/TuniVote.png></center>";
echo "<center><form action='compute.php' name='ctwice' method='post'><b><font size=3>Cochez les questions qui vous sont les plus importantes<br><font size=5>إختر الأسئلة التي تعتبرها  الأهم</font></b></font><br><br>";



$i=0;
$query = "select answer from ".$session." order by id";
//$query2 = "select title from questions order by id";
$query2 = "select question from questions order by id";
$queryar = "select questionar from questions order by id";
$queryt = "select title from questions order by id";

mysql_query('set character set utf8;');
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$erg2 = mysql_query($query2, $dbh) or die("MySQL ERROR: ".mysql_error());
$ergar = mysql_query($queryar, $dbh) or die("MySQL ERROR: ".mysql_error());
$ergt = mysql_query($queryt, $dbh) or die("MySQL ERROR: ".mysql_error());


//echo "<table><tr><td></td><td></td><td><img src=yes.jpg> Pour<br><img src=no.jpg> Contre<br><img src=indiff.jpg> Neutre<br><img src=skip.jpg> Je passe<br><br></td></td><td></td></tr></b></table>";
echo "<table><tr><td><img src=yes.jpg> Pour<br><img src=no.jpg> Contre<br><img src=indiff.jpg> Neutre<br><img src=skip.jpg> J'ai passé<br></td></tr></table>";

//echo "<table><tr><td bgcolor=\"dddddd\"><b>Nr</b></td><td bgcolor=\"dddddd\"><b>Question</b></td><td bgcolor=\"dddddd\"><b>R&eacute;ponse</b></td><td bgcolor=\"dddddd\"><b>Compte double</b></td></tr>";
echo "<table><caption>Vos réponses</caption><tr><th scope=\"col\">N°</th><th scope=\"col\">Question</th><th scope=\"col\">R&eacute;ponse</th><th scope=\"col\">Cochez ici</th></tr>";
echo "<tbody><br>";

$titlerow1=0;
$titlerow2=0;
$titlerow3=0;
$titlerow4=0;
$titlerow5=0;
$titlerow6=0;
$titlerow7=0;
$titlerow8=0;
$titlerow9=0;
$titlerow10=0;
$titlerow11=0;
$titlerow12=0;


while ($data = mysql_fetch_row($erg))
{
$t = $data[0] . "";
$result[$i] = $t;
$data = mysql_fetch_row($erg2)  ;
$t = $data[0] . "";
$title2[$i] = $t;

$data = mysql_fetch_row($ergar);
$t = $data[0] . "";
$titlear[$i] = $t;

$data = mysql_fetch_row($ergt);
$t = $data[0] . "";
$titlet[$i] = $t;



$j=$i+1;


if ($result[$i] == 1) {
    $symbol= "yes.jpg"    ;
} elseif ($result[$i] == 2) {
    $symbol= "indiff.jpg"    ;
} elseif ($result[$i] == 3) {
    $symbol= "no.jpg"    ;
}
elseif ($result[$i] == 4) {
    $symbol= "skip.jpg"    ;
}
elseif ($result[$i] == "") {
    $symbol= "skip.jpg"    ;
}

if ($titlet[$i] == "Sujet 1 - Système politique" && $titlerow1!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow1=1;
    }
if ($titlet[$i] == "Sujet 2 - Politique économique" && $titlerow2!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow2=1;
    }
if ($titlet[$i] == "Sujet 3 - Politiques fiscales et des finances" && $titlerow3!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow3=1;
    }
if ($titlet[$i] == "Sujet 4 - Politique étrangère" && $titlerow4!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow4=1;
    }
if ($titlet[$i] == "Sujet 5 - Institutions  - loi et ordre public" && $titlerow5!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow5=1;
    }
if ($titlet[$i] == "Sujet 6 - Justice - police et armée" && $titlerow6!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow6=1;
    }
if (beginsWith($titlet[$i],"Sujet 7") && $titlerow7!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow7=1;
    }
if ($titlet[$i] == "Sujet 8 - Politique sociale" && $titlerow8!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow8=1;
    }
if ($titlet[$i] == "Sujet 9 - Politique de la famille" && $titlerow9!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow9=1;
    }
if ($titlet[$i] == "Sujet 10 - Santé" && $titlerow10!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow10=1;
    }
if ($titlet[$i] == "Sujet 11 - Éthique" && $titlerow11!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow11=1;
    }
if ($titlet[$i] == "Sujet 12 - Culture et arts" && $titlerow12!=1)
    {
    echo "<tr class=odd ><td colspan=4 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titlerow12=1;
    }
    
   
    

if ($i % 2 == 0) 
 {
  
  echo "<tr class=odd><td>$j</td><td><a href=javascript:void(0) onclick=\"popup('popup','$j')\"> $title2[$i] <br> <font size=2>$titlear[$i]</font></a> </td><td> <img src=$symbol></td><td><input type=\"checkbox\" name=\"count[]\" value=\"$j\">  </td></tr>";
 }
 else
  {
  echo "<tr><td>$j</td><td><a href=javascript:void(0) onclick=\"popup('popup','$j')\"> $title2[$i]<br> <font size=2>$titlear[$i]</font></a> </td><td> <img src=$symbol></td><td><input type=\"checkbox\" name=\"count[]\" value=\"$j\">  </td></tr>";
 }

$i++;
}
 echo "<div class=\"popup\" id=\"popup\" style=\"visibility:hidden;\"><a href=# border:0px onclick=\"closepopup('popup')\">close</a> Loading, please ...</div> ";



//echo "</table><input type='submit' name='submit' value='Continuer'></form>"    ;
echo "</tbody></table><a href=\"getquestion.php\"><font color=CD0000><br>Retour aux questions</font><br><br></a><input type='submit' class=Button name='submit' value='Résultat'></form></center>"    ;
echo '<div id=linksbottom><ul><li> <a href=about.php> À propos de TuniVote </a></li> | <li> <a href=aboutus.php> Qui sommes nous? </a></li> | <li> <a href="mailto:info@tunivote.net"> Contact </a></li> 
<br><br><font color=white size=1>&copy;2011 </font><a href="http://www.tunicomp.net" target="_blank">tunicomp</a></ul></div>';

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
echo "<center> <img src=img/TuniVote.png></center>";
//echo"<font color=666666><br><br>Ch&#232;rs compatriotes,<br><br>vous &#234;tes les bienvenus.<b> TuniVote</b> est un outil en ligne qui aide les &eacute;lecteurs tunisiens &agrave; d&eacute;terminer leurs pr&eacute;f&eacute;rences politiques en vue des &eacute;lections de l'assembl&eacute;e constituante du 23 octobre 2011. <br>
//R&eacute;pondez aux questions en cliquant sur \"Pour\", \"Neutre\", \"Contre\" ou \"Je passe\" et TuniVote vous indiquera &agrave; la fin le parti le plus proche de vos opinions, <br>en se basant sur une comparaison avec les profils de tous les partis politiques participants aux &eacute;lections.<br><br></font></center>";

$qnumber2=$qnumber+1;
$width=600*$qnumber/$maxid;
$width2=600;
echo "<center><form action=\"getquestion.php?qnumber=$qnumber2\" method=\"post\"><center><font color=666666>Question <font  color=cd0000 style=bold size=4><b>$qnumber </b></font> parmi $maxid:</font> <font color=CD0000>$title</font> <br><p><font color=444444></center><div id=balken align=left; style=\"width: ".$width."px ; height: 5px; background-color:black; \"></div><div id=balken style=\"width: ".$width2."px ; height: 5px; background-color:#CD0000;   \"></div><center><br><b>$question</font></b></p>  <p><b><font color=444444 size=4>$questionar<br></font></b></p>";
?>


<br>
<center>
    
<input type="submit" class=Button name="button1" value="Pour">
<input type="submit" class=Button name="button2" value="Neutre">
<input type="submit" class=Button name="button3" value="Contre">
<input type="submit" class=Button name="button4" value="Je passe">     <br>
   <br>
   </center>
  
 <?


$query = "select max(id) from ".$session." ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$t = $data[0] . "";
$surstage = $t;


 //Hier query für Surveystage
 $i=0;
 while ($i < $maxid)
 {

 if($i< $surstage)
 {
 $j=$i+1;
 echo " <a href=\"getquestion.php?qnumber=$j&asw=0\"><font color=\"CD0000\">$j</font></a> ";
 }
 else
 {
  $j=$i+1;
 echo " $j ";
  }

 $i++;
 }
 
 if ($qnumber<$maxid && $qnumber>1 && $surstage!=56)
 {
  $j=$qnumber-1;
  if ($j<2) {$j=1;} 
 //echo "<br><br><a href=\"getquestion.php?qnumber=$j&asw=0\">Question précédente</a>  -  <a href=\"getquestion.php?qnumber=$surstage&asw=0\">Continuer à répondre aux questions</a> "   ;
 //echo "<br><br><a href=\"getquestion.php?qnumber=$j&asw=0\">Question précédente</a>  -   "   ;

 }
          //sollte eigentlich  if ($surstage==$maxid) sein
if ($surstage==56)
 {
 $j=$qnumber-1;
 if ($j<2) {$j=1;} 
 echo "<br><br><a href=\"getquestion.php?qnumber=$j&asw=0\">Question précédente</a>  -  <a href=\"getquestion.php?qnumber=$qnumber2&asw=0\">Question suivante</a> "   ;
echo "<br><br><a href=\"getquestion.php?qnumber=$maxid&asw=1\">Continuer</a> "   ;
 }
 
echo "</form> </center>";
echo "<br><font color=666666 size=1>&copy;2011 </font><a href=\"http://www.tunicomp.net\" target=\"_blank\">tunicomp</a></ul></div>";

  } 
 
  ?>                 
  
  
</font>


   
     
</body>
</html>
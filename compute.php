<?
 session_start();     
?>
 <head>
 <title>TuniVote</title>
 <link type="image/x-icon" href="img/tunivote.ico" rel="shortcut icon">
<meta name="author" content="Standard"/>
<meta name="description" content="TuniVote" />
<meta name="keywords" content="TuniVote,Tunisie vote,elections,vote,questions,r&eacute;ponses,aide,politique"/>
<meta name="date" content="2011-06-15T21:01:12+0100"/>
<meta name="robots" content="index, follow" />
<meta name="language" content="fr" />
<meta name="Content-Language" content="fr" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge" />


   <link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
   <link rel="stylesheet" type="text/css" href="style.css">


<script type="text/javascript" src="functions.js"></script>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11229311-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

   </head>
   
 <body>
<div id=links><ul><li><a href=index.php> Accueil </a></li><li><a href=aboutus.php> Qui sommes nous? </a></li><li><a href=about.php> À propos de TuniVote </a></li><li> <a href=guide.php> Guide d'utilisation </a></li><li> <a href=presse.php> Revue de presse </a></li><li> <a href=partner.php> Partenaires </a></li><li> <a href=team.php> L'équipe TuniVote </a></li><li> <a href="mailto:info@tunivote.net"> Contact </a></li>  </ul></div>      <br>
                    
<?php
function beginsWith($str, $sub) {
    return (strncmp($str, $sub, strlen($sub)) == 0);
}
?>
        <?
include_once("datenbank.php");

$session =   session_id();

$query = "SELECT COUNT(*) FROM respusers WHERE user='$session'";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$e=$data[0] . "";

if($e==0)
{
$query = "insert into respusers (user) values ('$session') ON DUPLICATE KEY UPDATE user = '$session'";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
}
//BERECHNUNG DER SCORES


if(isset($_POST["count"]))
{
$count = $_POST["count"];
//print_r($count);
}
else
{
$count="";
}

$flag=0;
function array_sub($array1, $array2 )
{
 global $session;
  global $dbh;
  


//The arrays are to be assumed same size
$i=sizeof($array1)-1;
global $count;
$val=0;

$val2=0;

//$count[count($count)]= $count[0];
//echo  print_r( $count );

while($i>-1)
{
        $e=$i+1;
$query = "update respusers set `".$e."`='$array1[$i]' where user='$session'";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());


//echo $array1[$i];
//echo $array2[$i];
  //      echo "$i<br>";
if ( !($array1[$i]==4 or $array2[$i]==4 or $array1[$i]=="" or $array2[$i]=="" ))
{
$multi=1;
    
    if(is_array($count))
         {
   
      if(in_array($e, $count) !=FALSE )
{
global $flag;
     $multi=2;
if($flag<count($count))
{
global $dbh;
$query = "select `double` from questions where id='".$e."' ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$t = $data[0] . "";
$anzdoub = $t;
$anzdoub=$anzdoub+1;
//echo $anzdoub;       
$query = "update questions set `double`='$anzdoub' where id='$e'";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$flag=$flag+1;
}
 
 
}
      }


        if($array1[$i]==$array2[$i])
        {
        $val=$val +2*$multi;

  //echo "2: $array1[$i] $array2[$i] <br>";

  }
        elseif(abs($array1[$i]-$array2[$i])<2)
        {
        $val=$val +1*$multi;

//        echo "1 : $array1[$i] $array2[$i] <br>";

        }


$val2=$val2+2*$multi;

}

$i--;
}

if($val2>0)
{
return $val/$val2;

}
else
{
return "pas encore particip&eacute;";
}

}


?>
             <?php



if(isset($_POST["count"]))
{
$count = $_POST["count"];
//print_r($count);
}
else
{
$count="";

}
//print_r($count);

$maxid=56;
//echo $queryadd;     
//   echo $queryadd;
    $data = array();
    $sql =  "select * from responses  where `$maxid` is not null";
    $result = mysql_query($sql, $dbh) or die("MySQL ERROR: ".mysql_error());


     //while( $partie[] = mysql_fetch_array($result) );

     while($partie2[]=mysql_fetch_array($result));



 echo"<br><br>";
//print_r(     $partie2 );


//ABSCHLUSSBERICHT

echo "<center> <img src=img/TuniVote.png>";
echo "<form name=results><font size=3><b>Votre r&eacute;sultat<br></font><font size=5>النتيجة </b></font><br><br><font size=2>Cochez les partis avec lesquels vous d&eacute;sirez <b>comparer vos r&eacute;ponses</b> puis cliquez sur</font><br><font size=4>إختر الأحزاب التي تريد مقارنة أجوبتها ثم إضغط على </font><br>";
//echo "<table><tr><td><img src=yes.jpg> Pour<br><img src=no.jpg> Contre<br><img src=indiff.jpg> Neutre<br><td><img src=yes.jpg> Pour<br><img src=no.jpg> Contre<br><img src=indiff.jpg> Neutre<br></table>";




$query = "select COUNT(partie) from responses  where `$maxid` is not null";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
$maxpart = $t;

//echo $maxpart;


$i=0;
$k=0;

//$query = "select answer from ".$session." order by id";
//$query2 = "select title from questions order by id";
$query2 = "select question from questions order by id";
$queryar = "select questionar from questions order by id";
$queryt = "select title from questions order by id";

mysql_query('set character set utf8;');
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$erg2 = mysql_query($query2, $dbh) or die("MySQL ERROR: ".mysql_error());
$ergar = mysql_query($queryar, $dbh) or die("MySQL ERROR: ".mysql_error());
$ergt = mysql_query($queryt, $dbh) or die("MySQL ERROR: ".mysql_error());


$result2= $_SESSION['antworten'];

$i=0;
while ($data = mysql_fetch_row($erg2))
{

$t = $data[0] . "";
$title2[$i] = $t;

$data = mysql_fetch_row($ergar);
$t = $data[0] . "";
$titlear[$i] = $t;

$data = mysql_fetch_row($ergt);
$t = $data[0] . "";
$titlet[$i] = $t;



$i++;
}

$i=sizeof($result2);

$j=0;
while ($j < $maxpart)
{
$value[0][$j]= array_sub($result2,array_slice($partie2[$j] ,1 ,$i+1   ) ) ;
$value[1][$j] =$partie2[$j][0];
 $j++;
}

 //Statt schleife array_walk

array_multisort($value[0],SORT_DESC,$value[1]);
//$result=array_multisort($value,$partie[$j][0]);

//Ergebnis in einer Tabelle ausgeben
$j=0;
//echo "<br><a href=\"#Details\"   ><b><font size=2>D&eacute;tails  <a href=javascript:void(0)   onclick=\"hidecb()\" > <font size=2>  Hide unselected  <a href=javascript:void(0)   onclick=\"showcb()\" >  <font size=2>  Show all  </font><br></b></a> <br>  <table border=1 width=100%><tr bgcolor=eeeeee><td><b>Rang</b></td><td><b>Parti</b></td><td></td><td><b>Degr&eacute; d&#146;affinit&eacute;s</b></td><td><b>Pourcentage</b></td><td></td></tr>";
echo "<br><a href=javascript:void(0)   onclick=\"hidecb()\" > <font size=2 color=CD0000>Afficher les partis cochés</font><a><font color=ffffff></font> <br> <br>";
//echo "<table><tr bgcolor=dddddd><td bgcolor=dddddd><b>Rang</b></td><td><b>Parti</b></td><td></td><td><b>Degr&eacute; d&#146;affinit&eacute;s</b></td><td><b>Pourcentage</b></td><td></td></tr>";

echo "<table><caption>Classement</caption><thead><tr><th scope=\"col\">Rang</th><th scope=\"col\">Parti</th><th scope=\"col\">Logo</th><th scope=\"col\" width=100>Affinit&eacute</th><th scope=\"col\">Pourcentage</th><th scope=\"col\"></th></tr></thead>";
//<tfoot><tr><th scope="row">Total</th><td colspan="4">67 designs</td></tr></tfoot>




while ($j < $maxpart)
{

//echo "Similarity to ".$value[1][$j]." : ";

$query = "select nom from parties where acro='".$value[1][$j]."' ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
$nomfr = $t;

$query = "select nomar from parties where acro='".$value[1][$j]."' ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
$nomar = $t;


echo "<tbody>";
                                                                
$width= 100*$value[0][$j];
if ($j % 2 == 0) {
   echo "<tr id=part$j class=odd><td>".($j+1)."</td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[1][$j]."')\"><font size=1>$nomfr</font> / <font size=2>$nomar</font></a></td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[1][$j]."')\"><img src=\"logos_small/".str_replace( " ", "", $value[1][$j] ).".jpg\" height=25px></a></td><td><div id=balken style=\"width: ".$width."px ; height: 5px; background-color:black; \"></div></td>  ";
   
   if(is_numeric($value[0][$j])) 
   {
    echo  "<td>".round($width,2)."%</td>";
   }
   else
   {
    echo  "<td>".$value[0][$j]."</td>";
   }
   
  echo "<td><input type=checkbox onClick=info('".$value[1][$j]."') id='".$value[1][$j]."' name=partbox ></td></tr>";
}
else {
 echo "<tr id=part$j><td>".($j+1)."</td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[1][$j]."')\"><font size=1>$nomfr</font> / <font size=2>$nomar</font></a></td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[1][$j]."')\"><img src=\"logos_small/".str_replace( " ", "", $value[1][$j] ).".jpg\" height=25px></a></td><td><div id=balken style=\"width: ".$width."px ; height: 5px; background-color:black; \"></div></td>  ";
   
 if(is_numeric($value[0][$j])) 
   {
    echo  "<td>".round($width,2)."%</td>";
   }
   else
   {
    echo  "<td>".$value[0][$j]."</td>";
   }
   
 echo  "<td><input type=checkbox onClick=info('".$value[1][$j]."') id='".$value[1][$j]."' name=partbox ></td></tr>";
}

//if ($j % 2 == 0) {
  // echo "<tr bgcolor=FAFAD2	><td>".($j+1)."</td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[1][$j]."')\">".$value[1][$j]."</a></td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[$1][j]."')\"><img src=\"logos_small/".str_replace( " ", "", $value[1][$j] ).".jpg\" height=25px></a></td><td><div id=balken style=\"width: ".$width."px ; height: 5px; background-color:black; \"></div></td><td>".round($width,2)."%</td></tr>";
//}
//else {
  //   echo "<tr><td>".($j+1)."</td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[1][$j]."')\">".$value[1][$j]."</a></td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[$1][j]."')\"><img src=\"logos_small/".str_replace( " ", "", $value[1][$j] ).".jpg\" height=25px></a></td><td><div id=balken style=\"width: ".$width."px ; height: 5px; background-color:black; \"></div></td><td>".round($width,2)."%</td></tr>";
//}

//echo "<div id=balken style=\"width: ".$width."px ; height: 5px; background-color:black; \"></div>$width %<br>";
$j++;
}
echo "</tbody></table>";

//echo "<br><b><a href=javascript:void(0)   onclick=\"hidecb()\" > <font size=2>  Affichez les partis cochés  <a href=javascript:void(0)   onclick=\"showcb()\" >  <font size=2>  Afficher tout les partis  </font><br></b></a> <br>";

//$maxpart=min($maxpart,8);
echo"<br><a><font color=ffffff>----</font> <a href=javascript:void(0)   onclick=\"showcb()\" >  <font size=2 color=CD0000>Afficher tous les partis</font><br></a> <br>";
echo "<br><br>Le tableau suivant repr&eacute;sente vos r&eacute;ponses par rapport &#224; celles des partis coch&eacute;s<br><b>cliquez</b> sur les r&eacute;ponses des partis pour découvrir leurs <b>justifications</b><br>";
echo "<table><tr><td><img src=yes.jpg> Pour<br><img src=no.jpg> Contre<br><img src=indiff.jpg> Neutre<br><img src=skip.jpg> J'ai passé</td></tr></table>";

echo "<a name=\"Details\"><table><caption>Réponses</caption><tr><th scope=\"col\">N°</th><th scope=\"col\">Question</th><th scope=\"col\">Vous</th>";
//<tr valign=\"bottom\" ><td><b>Nr</b></td><td><b>Question</b></td><td><b> Vous</b></td>  ";

while ($k< $maxpart)
{


 //echo "<td id=".$partie2[$k][0]."i"."0"."  style=\"display:none;\"> <a href=javascript:void(0) onclick=\"poppinfo('popup','".$partie2[$k][0]."')\"> <img src=\"logos_small/".str_replace( " ", "", $partie2[$k][0] ).".jpg\" height=25px><br><b>".$partie2[$k][0]." </b> </a></td>      ";
 echo "<td id=".$partie2[$k][0]."i"."0"."  style=\"display:none;\"> <a href=javascript:void(0) onclick=\"poppinfo('popup','".$partie2[$k][0]."')\"> <img src=\"logos_small/".str_replace( " ", "", $partie2[$k][0] ).".jpg\" height=25px><br><b>".$partie2[$k][0]." </b> </a></td>";


$k++;
}

echo "</tr>";


$i=0;


$titledummy="";

while ($i<sizeof($result2))
{
//$t = $data[0] . "";
//$result2[$i] = $t;
//$data = mysql_fetch_row($erg2)  ;
//$t = $data[0] . "";
//$title2[$i] = $t;

$j=$i+1;


if ($result2[$i] == 1) {
    $symbol= "yes.jpg"    ;
} elseif ($result2[$i] == 2) {
    $symbol= "indiff.jpg"    ;
} elseif ($result2[$i] == 3) {
    $symbol= "no.jpg"    ;
}
elseif ($result2[$i] == 4) {
    $symbol= "skip.jpg"    ;
}
elseif ($result2[$i] == "") {
    $symbol= "skip.jpg"    ;
}


    

    //<tr valign=\"bottom\" ><td><b>Nr</b></td><td><b>Question</b></td><td><b> Vous</b></td>  ";




if ($titlet[$i] != $titledummy)
    {
    echo "<tr class=odd ><td colspan=12 bgcolor=666666><font color=eeeeee>$titlet[$i]</font></td></tr>";
    $titledummy =$titlet[$i];   
    
    

    }


  if ($i % 2 == 0) {
echo "<tr class=odd><td>$j</td><td><a href=javascript:void(0) name=\"countt\" onclick=\"popup('popup','$j')\"> $title2[$i]<br><font size=2> $titlear[$i]</font></a>  </td><td> <center><img src=$symbol> </center></td>";
   }
   else
   {
echo "<tr><td >$j</td><td><a name=\"countt\" href=javascript:void(0) onclick=\"popup('popup','$j')\"> $title2[$i]<br> <font size=2> $titlear[$i]</font></a>  </td><td> <center><img src=$symbol></center> </td>";
   }

 $k=0;
while ($k< $maxpart)
{
if ($partie2[$k][$j] == 1) {
    $symbol= "yes.jpg"    ;
} elseif ($partie2[$k][$j] == 2) {
    $symbol= "indiff.jpg"    ;
} elseif ($partie2[$k][$j] == 3) {
    $symbol= "no.jpg"    ;
}
elseif ($partie2[$k][$j] == 4) {
    $symbol= "skip.jpg"    ;
}
elseif ($partie2[$k][$j] == "") {
    $symbol= "skip.jpg"    ;
}

 echo "<td  id=".$partie2[$k][0]."i".$j." style=\"display:none;\"><a  href=javascript:void(0) onclick=\"popup2('popup','".str_replace( " ", "", $partie2[$k][0] )."','$j')\"><center><img src=\"$symbol\"></center> </a> </td>      ";

$k++;
}

echo "</tr>";

$i++;
}

echo "</tbody></table>";


$query = "select COUNT(*) from questions";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
$maxid = $t+1;


 echo "<a href=\"compute.php?choice=1\"><br><font color=CD0000>Changer la s&eacute;lection des partis </font></a>  <font color=ffffff>----</font>   ";
// echo "<a href=\"index.php\"><font color=CD0000>Red&eacute;marrer TuniVote</font></a>";
  echo "<a href=\"getquestion.php\"><font color=CD0000>Retour aux questions</font></a>";
 echo "<font color=ffffff>----</font><a href=\"getquestion.php?qnumber=$maxid&asw=0\">     <font color=CD0000> Changer l'importance des r&eacute;ponses </font></a></form>";


//echo array_slice($partie[1] ,1 ,$i+1   );
 //Sortieren mit array_multisort
   
   
   echo "<div class=\"popup\" id=\"popup\" style=\"visibility:hidden;\"><a href=javascript:void(0) border:0px onclick=\"closepopup('popup')\">fermer</a> Loading, please ...</div> ";
   echo '<div id=linksbottom><ul><li> <a href=about.php> À propos de TuniVote </a></li> | <li> <a href=aboutus.php> Qui sommes nous? </a></li> | <li> <a href="mailto:info@tunivote.net"> Contact </a></li> 
<br><br><font color=white size=1>&copy;2011 </font><a href="http://www.tunicomp.net" target="_blank">tunicomp</a></ul></div>';
?>
  


     </font>    

  </body>
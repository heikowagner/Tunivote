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
   
<center> <form>  
   <?php

include_once("datenbank.php");
mysql_query('set character set utf8;');

function array_sub($array1, $array2 )
{
 global $session;
  global $dbh;
  


//The arrays are to be assumed same size
$i=sizeof($array1)-1;

$count="";


$val=0;

$val2=0;


while($i>-1)
{

//echo $array1[$i];
//echo $array2[$i];

if ( !($array1[$i]==4 or $array2[$i]==4 or $array1[$i]=="" or $array2[$i]=="" ))
{
$multi=1;

     if(count($count) >1)
     {
        if(array_search($i, $count) !=FALSE )
{
$multi=2;
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

<?


$query = "SELECT COUNT(*) FROM respusers";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$gesamt=$data[0] . "";

echo "Teilnehmer : $gesamt <br>";

$query = "SELECT COUNT(*) FROM questions";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$fragen=$data[0] . "";

echo "Anzahl der Fragen : $fragen<br>";

$i=0;

echo "Durchnitt:";
while($i < $fragen)
{
$i++;
       
$query = "SELECT  sum( `".$i."` )  FROM respusers where `".$i."`< 4";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$durch=$data[0] . "";

$query = "SELECT  count( `".$i."` )  FROM respusers where `".$i."`< 4";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$gesamt2=$data[0] . "";

$query = "SELECT  `double`  FROM questions where id='$i' ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$doppelt=$data[0] . "";

$query = "SELECT  count( `".$i."` )  FROM respusers where `".$i."`=1";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$pour=$data[0] . "";

$query = "SELECT  count( `".$i."` )  FROM respusers where `".$i."`=2";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$neutre=$data[0] . "";

$query = "SELECT  count( `".$i."` )  FROM respusers where `".$i."`=3";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data = mysql_fetch_row($erg);
$contre=$data[0] . "";

if($gesamt2 !="0")
{
echo "<br>Frage $i wurde $doppelt mal doppelt gezählt es wurde $pour mal dafür, $neutre mal neutral und $contre mal dagegen gestimmt :"     ;

echo $durch/$gesamt2;
     $j=$i-1;
$result2[$j]=round($durch/$gesamt2);

$mostpop[0][$j]=$i;
$mostpop[1][$j]=$doppelt;

$left=200*((($durch)/$gesamt2)-2) -5 ;
//echo "<br>$left";

echo "<div id=balken2><font style=\"color:white; position:static; margin-left:".$left."px;\">&Delta;</font></div>   ";
}

}


echo "<h1>Vergleich des Durschnitts mit partis</h1>"
?>



<?
    $data = array();
    $sql = "SELECT * FROM  responses";
    $result = mysql_query($sql, $dbh) or die("MySQL ERROR: ".mysql_error());


     //while( $partie[] = mysql_fetch_array($result) );

     while($partie2[]=mysql_fetch_array($result));



 echo"<br><br>";
 
 
$query = "select COUNT(partie) from responses";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
 $t = $data[0] . "";
$maxpart = $t;

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
                                        
                                        
                                        
                                        
                                        $j=0;
//echo "<br><a href=\"#Details\"   ><b><font size=2>D&eacute;tails  <a href=javascript:void(0)   onclick=\"hidecb()\" > <font size=2>  Hide unselected  <a href=javascript:void(0)   onclick=\"showcb()\" >  <font size=2>  Show all  </font><br></b></a> <br>  <table border=1 width=100%><tr bgcolor=eeeeee><td><b>Rang</b></td><td><b>Parti</b></td><td></td><td><b>Degr&eacute; d&#146;affinit&eacute;s</b></td><td><b>Pourcentage</b></td><td></td></tr>";
echo "<br><a href=javascript:void(0)   onclick=\"hidecb()\" > <font size=2 color=CD0000>Afficher les partis cochés </font><a><font color=ffffff>----</font> <a href=javascript:void(0)   onclick=\"showcb()\" >  <font size=2 color=CD0000>Afficher tout les partis</font><br></a> <br>";
//echo "<table><tr bgcolor=dddddd><td bgcolor=dddddd><b>Rang</b></td><td><b>Parti</b></td><td></td><td><b>Degr&eacute; d&#146;affinit&eacute;s</b></td><td><b>Pourcentage</b></td><td></td></tr>";

echo "<table><caption>Classement</caption><thead><tr><th scope=\"col\">Rang</th><th scope=\"col\">Parti</th><th scope=\"col\">Logo</th><th scope=\"col\">Affinit&eacute</th><th scope=\"col\">Pourcentage</th><th scope=\"col\"></th></tr></thead>";
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
   echo "<tr id=part$j class=odd><td>".($j+1)."</td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[1][$j]."')\">$nomfr / $nomar</a></td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[1][$j]."')\"><img src=\"logos_small/".str_replace( " ", "", $value[1][$j] ).".jpg\" height=25px></a></td><td><div id=balken style=\"width: ".$width."px ; height: 5px; background-color:black; \"></div></td>  ";
   
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
 echo "<tr id=part$j><td>".($j+1)."</td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[1][$j]."')\">$nomfr / $nomar</a></td><td><a href=javascript:void(0) onclick=\"poppinfo('popup','".$value[1][$j]."')\"><img src=\"logos_small/".str_replace( " ", "", $value[1][$j] ).".jpg\" height=25px></a></td><td><div id=balken style=\"width: ".$width."px ; height: 5px; background-color:black; \"></div></td>  ";
   
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

echo "<br><b>Top 10 doppelt gewählte Fragen:</b>" ;
array_multisort($mostpop[1],SORT_DESC,$mostpop[0]);

$i=0     ;
while ($i<10)
{
echo "<br>Frage ".$mostpop[0][$i]." mit ".$mostpop[1][$i]." doppeltwahlen";
$i++;
}
?>                     </form> </center>
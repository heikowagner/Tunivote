<?
 session_start();
?>

<head>
   <link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
   <link rel="stylesheet" type="text/css" href="style.css">

<script type="text/javascript" language="JavaScript">

function printPage()
{
 focus();
  if (window.print)
  {
   jetztdrucken = confirm('Voulez vous imprimer la page pour confirmer vos positions?');
   if (jetztdrucken) window.print(); } }

 </script>
   </head>
 <body OnLoad="printPage()">
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
echo "<img src=img/tunivote.jpg><form action='parties.php' method='post'> Veuillez entrer votre login et mot de passe pour acc&eacute;der au questionnaire \"TuniVote\" consacr&eacute; aux partis

<br>Login: <input type=\"text\" name='partie' /><br />
Mot de passe: <input type=\"text\" name='password' />"     ;
echo "<br><input type=\"submit\" name=\"login\" value=\"Login\"></form>";
}
else
{

if (!isset($_SESSION['partie']))
{
$partie=$_POST["partie"]      ;
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




$i=0;

$query = "select * from responses where partie='$partie'";
mysql_query('set character set utf8;');

$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());

$mailtext="";
echo "<center> <img src=img/tunivote.jpg>" ;

echo("<p>Ch&#232;r responsable du parti <b>\"$partie\"</b>, merci d&#039;avoir r&eacute;pondu &#224; nos questions et d&#039;avoir particip&eacute; au projet <b>TuniVote</b>. </p>");


echo "<table><tr><td></td><td></td><td><img src=yes.jpg> Pour<br><img src=no.jpg> Contre<br><img src=indiff.jpg> Neutre<br><br></td></td><td></td></tr><tr><td><b>Nr</b></td><td><b>R&eacute;ponse</b></td><td><b>Question</b></td><td><b>Justification</b></td></tr></b>";
$data = mysql_fetch_row($erg)  ;
$i=0;
foreach ($data as $key => $value)
{


mysql_query('set character set utf8;');
$query = "select question from questions  where id= ".$i." ";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$data2 = mysql_fetch_row($erg);
$t = $data2[0] . "";
$question = $t;

$query = "select * from respreas where partie='$partie'";
mysql_query('set character set utf8;');

$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
$awreason = mysql_fetch_row($erg)  ;


if ($data[$i] == 1) {
    $symbol= "yes"    ;
    $symbolfr= "Pour"   ;
} elseif ($data[$i] == 2) {
    $symbol= "indiff"    ;
    $symbolfr= "Neutre"   ;
} elseif ($data[$i] == 3) {
    $symbol= "no"    ;
    $symbolfr= "Contre"   ;
}
elseif ($data[$i] == 4) {
    $symbol= "skip"    ;
}
elseif ($data[$i] == "") {
    $symbol= "skip"    ;
    $symbolfr= "Je passe"    ;  
}
if ($i>0)
{
echo "<tr><td>$i</td><td><img src=$symbol.jpg></td><td>$question</td><td>$awreason[$i]</td></tr>";

$mailtext="$mailtext \n Q $i - $symbolfr - $question - $awreason[$i]";
}
$i++;
$j=$i;

}

$mailtext="Chèr responsable du parti $partie,\nmerci d'avoir répondu à nos questions et d'avoir participé au projet TuniVote. Voici la confirmation de vos réponses\n\n $mailtext";

//echo "<tr><td>$j</td><td>$title2[$i] </td><td> $result[$i]</td></tr>";



echo "</table>"    ;
?>
<?php
  $to = $_POST["email"];
 $subject = "Confirmation du parti $partie pour TuniVote";
 //echo $mailtext;
 $header = 'From: info@tunivote.net' . "\r\n" .
 'Cc: info@tunivote.net' . "\r\n".
 'Content-Type: text/plain Charset=utf-8' . "\r\n".
    'Reply-To: info@tunivote.net' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();




 if (mail($to, $subject, $mailtext, $header)) {
   echo("<p><b>Pour confirmer votre participation et la saisie de vos r&eacute;ponses, nous vous avons envoy&eacute; un Mail avec succ&eacute;s &#224; $to!</b></p>");
  } else {
  echo("<p><b>L&#039;envoi du Mail de confirmation &#224; $to a &eacute;chou&eacute;, ou bien parce que vous n&#039;avez pas entr&eacute; votre Mail ou votre Mail n&#039;est pas valable!</b></p>");

  }

  }
 ?>
 </body>
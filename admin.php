<head>
   <link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
   <link rel="stylesheet" type="text/css" href="style.css">

   </head>    <center>

<?php

  include_once("datenbank.php");
if(isset($_POST["pass"]))
{

  if ("tun1#adm89." == $_POST["pass"])
  {
  //echo "Login erfolgreich !";



    $acro=$_POST["acro"];
     mysql_query('set character set utf8;');
    $query = "select nom from parties where acro='$acro' ";
    $erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
    $data = mysql_fetch_row($erg);
    $nom = $data[0] . "";

    $query = "select nomar from parties where acro='$acro' ";
    $erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
    $data = mysql_fetch_row($erg);
    $nomar = $data[0] . "";

    $query = "select password from parties where acro='$acro' ";
    $erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
    $data = mysql_fetch_row($erg);
    $password = $data[0] . "";


  echo "<font size=4><img src=img/tunivote.jpg> <br><br>Ch&#232;r(e) responsable du parti: <b>$nom / $nomar </b>, <br>voici votre login et mot de passe personnels pour acc&eacute;der au questionnaire \"TuniVote\" consacr&eacute; aux partis sur <b><a href=\"www.tunivote.net/partis.php\">www.tunivote.net/partis.php</a></b><br><br>  ";

  echo "<table border=1 bgcolor=eeeeee><tr><td><b>Login:</b></td><td>$acro</td></tr> <tr><td><b>Password:</b></td><td>$password </td></tr></b> </table>"   ;

  }
  else
  {
  echo "Login incorrect";
  }

}
else
{
?>

        <form action=admin.php method=post>
  Password :
  <input type=password name=pass>
<select name="acro">
<?     mysql_query('set character set utf8;');
    $i=0;
    $query = "select nom from parties";
    $erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
    while ($data = mysql_fetch_row($erg))
    {
    $nom2[$i] = $data[0] . "";
    $i++;
    }

    $i=0;
    $query = "select acro from parties";
    $erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
    while ($data = mysql_fetch_row($erg))
    {
    $acro = $data[0] . "";
    echo "<option value=$acro>$nom2[$i]</option>" ;
    $i++;
    }



  ?>

</select>
  <input type=submit>
  <form>    </center>
<? } ?>
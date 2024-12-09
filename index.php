<html>
<head>
<title>TuniVote</title>
 <link type="image/x-icon" href="img/tunivote.ico" rel="shortcut icon">
   <link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
   <link rel="stylesheet" type="text/css" href="style.css">

<script type="text/javascript" src="functions.js"></script>

 <meta http-equiv="X-UA-Compatible" content="IE=edge" />

   <link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
   <link rel="stylesheet" type="text/css" href="style.css">
   <script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'ar'}
</script>
</head>
<body>

<div id=links><ul><li><a href=index.php> Accueil </a></li><li><a href=aboutus.php> Qui sommes nous? </a></li><li><a href=about.php> À propos de TuniVote </a></li><li> <a href=guide.php> Guide d'utilisation </a></li><li> <a href=presse.php> Revue de presse </a></li><li> <a href=partner.php> Partenaires </a></li><li> <a href=team.php> L'équipe TuniVote </a></li><li> <a href="mailto:info@tunivote.net"> Contact </a></li>  </ul></div>      <br>
<center> <img src=img/TuniVote.png> 
<form style="text-align:left" action=getquestionpress.php>
<font color=666666><br><br>Cher(e)s compatriotes,<br><br><b>TuniVote</b> est un outil en ligne qui aide les &eacute;lecteurs tunisiens &agrave; d&eacute;terminer leurs pr&eacute;f&eacute;rences politiques en vue des &eacute;lections de l'assembl&eacute;e constituante du 23 octobre 2011. <br>
<br>R&eacute;pondez aux questions en cliquant sur "Pour", "Neutre", "Contre" ou "Je passe" et TuniVote vous indiquera &agrave; la fin le parti le plus proche de vos opinions, en se basant sur une comparaison avec les réponses des partis politiques qui ont participé à TuniVote.<br><br>

<center><input type="submit" class=Button name="button1" value="D&eacute;marrer"> </center>

<br>
<b>Recommendez TuniVote &agrave; vos amis: </b>  <br> <br>

        <g:plusone></g:plusone>
        <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>    <iframe src="http://www.facebook.com/plugins/like.php?href=http://www.tunivote.net"
        scrolling="no" frameborder="0"
        style="border:none; width:350px; height:24px"></iframe>

        <br><br><b>Les partis suivants ont r&eacute;pondu aux questions et seront consid&eacute;r&eacute;s dans votre résultat:</b>
     <?
     echo "<div id=logos><ul id=paris>";
     include_once("datenbank.php");
     
     mysql_query('set character set utf8;');
$query = "select max(id) from questions";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
 $data = mysql_fetch_row($erg);
  $t = $data[0] . "";
$maxid =$t;

mysql_query('set character set utf8;');
$query = "select `partie` from responses  where `$maxid` is not null";
$erg = mysql_query($query, $dbh) or die("MySQL ERROR: ".mysql_error());
while ($data = mysql_fetch_row($erg))
{
$t = $data[0] . "";
$acro =$t;
$acro=str_replace(' ','',$acro);
echo "<li><a href=javascript:void(0) onclick=\"poppinfo('popup','$acro')\">  <img src=logos_start/$acro.jpg></a></li>";
}
echo "</ul></div>";


     ?>
   


</form>
<li><br><font size=1 color=666666>
<br>
TuniVote est compatible avec les navigateurs suivants (cookies et javascript activés):
<br>

    * Mozilla Firefox (version 3 et supérieures)
    <br>    
    * Internet Explorer (version 7 et supérieures)
    <br>    
    * Opéra (version 9 et supérieures)
    <br>    
    * Safari (version 3.2 et supérieures)
    <br>    
    * Google Chrome (version 3 et supérieures)
    <br><br>    
&copy;2011 <a href="http://www.tunicomp.net" target="_blank">tunicomp
<br>
</font></a></li>
<?
echo "<div class=\"popup\" id=\"popup\" style=\"visibility:hidden;\"><a href=# border:0px onclick=\"closepopup('popup')\">close</a> Loading, please ...</div> ";
?>
             </center>

     </font>

</body>
</html>
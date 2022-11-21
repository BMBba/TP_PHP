
4/ Affichage de l'image:
Ce script sera 'afficher_image.php' et est composé tel que:
<?php
// connexion à la base de données:
mysql_connect("localhost","utilisateur","motdepasse");
mysql_select_db("test");
// on récolte les données contenues dans la table:
$requete = mysql_query ("SELECT * FROM image WHERE id='$id'");
$data = mysql_fetch_array ($requete);
$id = $data["id"];
$donnees_binaires = $data["donnees_binaires"];
$type_fichier = $data["type_fichier"];
header ( "contenttype:
$type_fichier");
print "$donnees_binaires";
?>
5/ Le lien vers l'image:
Ce code afficher l'image directement où vous l'insérez.
<?php
print "<img src='afficher_image.php?id=$id'/>";
?>

<?php
include("connexion.php");
$id=$_GET["id_change"];
$donne=$pdo->prepare("select * from utilisateurs where id=$id ");
$donne->execute();
$resultat=$donne->fetch();
/* echo(); */
if ($resultat['roles']== "Utilisateur") {
    $modifier=$pdo->prepare("update utilisateurs set roles='Admin' where id=$id");
    $modifier->execute();

    header('location:admin.php');
} else {
    $modifier=$pdo->prepare("update utilisateurs set roles='Utilisateur' where id=$id");
    $modifier->execute();
    header('location:admin.php');
}

?>
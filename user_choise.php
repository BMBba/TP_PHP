
    <?php
    include("connexion.php");
    $email=$_GET["email"];
    $donne=$pdo->prepare("select * from utilisateurs where  Eat = 0 AND  email=$email ");
    $donne->execute();
    $resultat=$donne->fetch();
    /* echo(); */
    if ($resultat['roles']== "Utilisateur") {
        $choix=$pdo->prepare("update utilisateurs set roles='Admin' where=");
        $choix->execute();
    
        header('location:admin.php');
    } else {
        $choix=$pdo->prepare("update utilisateurs set roles='Utilisateur' where id=$id");
        $choix->execute();
        header('location:simple_user.php');
    }
    
    ?>


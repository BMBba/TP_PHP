<?php

try

{

       // On se connecte à MySQL

       $bdd = new PDO('mysql:host=localhost;dbname=AMO', 'root', '');

}

catch(Exception $e)

{

       // En cas d'erreur, on affiche un message et on arrête tout

        die('Erreur : '.$e->getMessage());

}

        

// Si tout va bien, on peut continuer



// On récupère tout le contenu de la table jeux_video

$reponse = $bdd->query('SELECT * FROM UTILISATEUR');



// On affiche chaque entrée une à une

while ($donnees = $reponse->fetch())

{

?>


     <?php echo $donnees['nom']; ?><br />

     <?php echo $donnees['prenom']; ?>
      <?php echo $donnees['matricule']; ?> euros !<br />

    <?php echo $donnees['email']; ?> 
    <?php echo $donnees['role']; ?> au maximum<br />


<?php

}

         

$reponse->closeCursor(); // Termine le traitement de la requête



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form name="fo" method="post" action="">
Prenom: <input type="text" name="prenom">
Nom: <input type="text" name="nom">
Matricule: <input type="text" name="matricule"> 
E-mail: <input type="text" name="email">
Rôle: <input type="text" name="role">
<button type="submit" class="btn btn-primary mb-3">Confirm identity</button>
</form>
</body>
</html>


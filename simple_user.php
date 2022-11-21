<?php
session_start();
// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}
// On se connecte à là base de données
require_once('connexion.php');
$id = $_SESSION['id'];
// On détermine le nombre total d'utilisateurs
$sql = 'SELECT COUNT(*) AS nb_utilisateurs FROM `utilisateurs` WHERE Etat=0';

// On prépare la requête
$req = $pdo->prepare($sql);

// On exécute
$req->execute();

// On récupère le nombre d'utilisateurs
$result = $req->fetch();

$nbutilisateurs = (int) $result['nb_utilisateurs'];

// On détermine le nombre d'utilisateurs par page
$parPage = 5;

// On calcule le nombre de pages total
$pages = (int) ceil($nbutilisateurs / $parPage);


// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

$sql = 'SELECT * FROM `utilisateurs` where Etat=0 and id !='.$id.' ORDER BY `date` DESC LIMIT :premier, :parpage';

// On prépare la requête
$req = $pdo->prepare($sql);

$req->bindValue(':premier', $premier, PDO::PARAM_INT);
$req->bindValue(':parpage', $parPage, PDO::PARAM_INT);

// On exécute
$req->execute();

// On récupère les valeurs dans un tableau associatif
//$utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<?php
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   else
      $bienvenue=$_SESSION["prenomNom"];?>
      
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        
        <style>
         *{
            font-family:arial;
         }
         header{
            border:solid #1996D3;
            display:flex;
            justify-content:center;
            gap: 30%;
            padding: 0.2%;
            
         }
         body{
            margin:20px;
         }
         a{
         
         }
         a:hover{
            text-decoration:none;
          color:#00CA4D
         }
         .container{
    max-width:max-content;
    display:flex;
    justify-content:center;
    
         }
         nav{
            padding:0.1%;
      
         }
         
         button{
            background-image: url("image/rch.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            border-radius :10px;
         
         }
         #archive,#modif,#change{
            
         width: 25px;
         

      }
         #action{
            display:flex;
            justify-content:center;
            gap: 30px;
         }
         th{
            color:#1996D3;
         }
         #act{
            display:flex;
            justify-content:center;
         }
         #profil{
            width:50px;

         }
         #retour{
            opacity:0.2;
         }
         #retour:hover{ 
          opacity:1;  
         
         }
      </style>
   </head>
   <body onLoad="document.fo.login.focus()">
   <header>
      
<span>
      <img  id="profil" width="50" height="50" src=<?='http:://localhost/essai/TP_AMOprofil/'.$_SESSION['photo'];?> alt="">
    <h><?php echo $bienvenue?></h>
   </span>
     <span id="emar">
      <a href="">  <h>liste des employers </h> </a>
      </span>

      
        <span>
        <a href="deconnexion.php"> <img id="retour" src="image/login_FILL0_wght400_GRAD0_opsz48.svg" alt=""></a> 
        </span>
        
</span>
</header>
  <nav> 
  <form class="form-inline" method="POST" action="" >
            <input class="form-control mr-sm-2" name="recherche" type="search" placeholder="Mots-clés" aria-label="Search">
            <button class="btn btn-outline-info my-2 my-sm-0" name="submit" type="submit"><img id="imgr" src="image/h.jpg" alt=""></button>
         </form>
  </nav>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Matricule</th>
          <th>Date d'inscription</th>
          
        </tr>
      </thead>
     
      <?php 
      //include ("connexion.php");
      //$req=$pdo->prepare("select * from utilisateurs where Etat=0 ");
      //$req->execute();
      if (isset($_POST["recherche"])) {
         $rech= $_POST["recherche"];
         if (!empty($rech)) {
     
           $req = "SELECT * FROM utilisateurs WHERE Etat=0 AND nom LIKE '%$rech%' OR prenom LIKE '%$rech%'  ";
            $req = $pdo->prepare($req);
           $req->execute();
         }}
      while($row=$req->fetch())
      {
         $id=$row["id"];
         $matricule=$row["matricule"];
         $prenom=$row["prenom"];
         $nom=$row["nom"];
         $email=$row["email"];
         $dateInscription=$row["date"];

         echo' <tbody><tr> 
         <td>'.$prenom.'</td>
         <td>'.$nom.'</td>
         <td>'.$email.'</td>
         <td>'.$matricule.'</td>
         <td>'.$dateInscription.'</td>
        </tbody> ';
      } ?>
     
       </table>
<div class="container ">              
  <ul class="pagination ">                        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="?page=<?= $currentPage - 1 ?>" class="page-link"><</a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                          <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="?page=<?= $currentPage + 1 ?>" class="page-link">></a>
                        </li>
      </ul>
      </div>
  

   </body>
</html>

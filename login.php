<?php
   session_start();
   @$email=$_POST["email"];
   @$pass=md5($_POST["pass"]);
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
     
      include("connexion.php");
      $sel=$pdo->prepare("select * from utilisateurs where email=? and pass=? limit 1");
      $sel->execute(array($email,$pass));
      $tab=$sel->fetch();
      

      if($sel -> rowCount()>0){
         if ($tab['roles'] == "Admin") {
            $_SESSION["prenomNom"]=ucfirst(strtolower($tab["prenom"]))
             . " ".strtoupper($tab["nom"]). " ".'<br />'."".($tab["matricule"]);
             $_SESSION["autoriser"]="oui";
             $_SESSION["id"] = $tab["id"];
             $_SESSION['photo']=$tab['photo'];
             header("location:admin.php");
         }
         else {
            $_SESSION["prenomNom"]=ucfirst(strtolower($tab["prenom"]))
            . " ".strtoupper($tab["nom"]). " ".$replace."".($tab["matricule"]);
            $_SESSION["autoriser"]="oui";
            $_SESSION["id"] = $tab["id"];
             $_SESSION['photo']=$tab['photo'];
            header("location:simple_user.php");
         }
         
      }else{
         header("location: login.php?erreur=email ou mot de passe incorrect!");
         exit;
      }
   //}    
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <style>
         *{
            font-family:arial;
            margin:0px;
            padding:0px;
         }
         #entete{
            background-image: url("image/verdure.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            width: 650px;
            height: 100px;
            border:solid 1px #00CA4D;
            border-radius: 6px ;
         

         }
         main{
            border:solid 1px #00CA4D;
            width: 650px;
            margin:20px;
            height: 500px;
            
            border-radius :10px;
            
         }

         label{
         color:#1996D3;
         position:relative;
         right:18%;
         
         }
         
         input{
            border:solid 1px #2222AA;
            margin-bottom:10px;
            padding:16px;
            outline:none;
            border-radius:6px;
            width: 300px;
         }
         .erreur{
            color:#CC0000;
            margin-bottom:10px;
         }
         a{
            font-size:12pt;
            color:#00A400;
            text-decoration:none;
            font-weight:normal;
            background-color:white;

         }
         a:hover{
            text-decoration:underline;
         }
         #verdure{
      
         }
         #seconnecter{
         width: 110px;
         background-color: #1070FF;
         }
         h2{
            border:solid #00CA4D;
            max-width: max-content;
            border-radius: 5px;
           
            background-color: #00CA4D;;
         }
         form{
            
         }
      </style>
   </head>
   <body onLoad="document.fo.email.focus()">
     <center> 
      <main>
         <div id="entete">
            <br><br><br><br><br><br>
         <h2>Connexion</h2><br>
      <div class="erreur"><?= $_GET['erreur'] ?? null ?></div>
   
      </div><br><br><br><br><br>
      <form  method="post" action="">
         <div>
         <label for="email">Adresse email</label><br>
         <input type="text" name="email" placeholder="votre mail" /><br /><br>
         </div>
         <div>
         <label for="pass">Mot de passe</label><br>
         <input type="password" name="pass" placeholder="votre mot de passe" /><br /><br>
         </div>
         <input id="seconnecter" type="submit" name="valider" value="Se connecter" />
      </form>  <h1> <a href="inscription.php">Créer un compte</a> </h1>
      </main>
      </center>
   </body>
</html>
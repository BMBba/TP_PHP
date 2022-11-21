<?php 
if(isset($_GET["id_modif"])){
   $id = $_GET["id_modif"];
   if(!empty($id) && is_numeric($id)){
      include("connexion.php");
      $list = "SELECT * FROM utilisateurs WHERE id=$id";
      $result = $pdo->query($list);
      $data = $result->fetch();
          $id = $data["id"];
          $prenom = $data["prenom"];
          $nom = $data["nom"];
          $email = $data["email"];

        
          }

      }
      if(isset($_POST["valider"])){
         if(isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["email"])){
  
             $prenom = $_POST["prenom"];
             $nom = $_POST["nom"];
             @$email = $_POST["email"];
             $date_modif = date('y-m-d');
            
             include("connexion.php");
             $list = "UPDATE utilisateurs SET prenom = '$prenom', nom = '$nom', 
             email = '$email', dateModifier = '$date_modif' WHERE id = $id";
             $pdo->exec($list);
             header("location: admin.php");
           }
         }?>
      <!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
       <style>
         *{
            font-family:arial;
         }
         body{
            margin:20px;
         }
         h1{
            
            background-color: #00CA4D;
            max-width:max-content;
            border-radius:0.5rem;
         }
         input{
            border:solid 1px #00CA4D;
            margin-bottom:10px;
            padding:16px;
            outline:none;
            border-radius:6px;
            width: 300px;
            height: 4px;
         }
         select{
         }
         .erreur{
            color:#CC0000;
            margin-bottom:10px;
         }
         #ins1{

         }
         #ins2{

         }
         .ins{ 
         display:flex;
         justify-content: center;
         gap: 20px;
         
         }
         #inscription{
            border: solid #00CA4D ;
            height: 500px;
            width: 900px;
            border-radius: 10px;
          
         }
         #btn{
            height: 50px;
            width: 85px;
            background-color:#00A400;
            position: relative;
            left:85px;
            justify:content;
         }
         label{
         color:#1996D3;
         display:flex;
         }
      </style>
   </head>
   <body>
      <center >
         <div id="inscription">
      <h1>modification</h1>
      <form class="ins" name="fo" method="post" action="" >

         <div id="ins1">
      <label for="nom" >Nom <span style="color:red;">*</span></label><br>
         <input type="text" name="nom" placeholder="Nom" value="<?php echo $nom?>" /> <br><br>
         <label for="prenom">Prénom <span style="color:red;">*</span></label><br>
         <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom?>" /><br><br>
         <label for="email" >email <span style="color:red;">*</span></label><br>
         <input type="text" name="email" placeholder="Email" value="<?php echo $email?>" /><br><br>
         <input  id="btn" type="submit" name="valider" value="Modifier"/>
         </div>
      </form>
      </div>
      </center>
   </body>
</html>
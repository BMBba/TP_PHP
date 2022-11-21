<?php
   session_start();
   if (isset($_POST['valider'])) {
      # code...
 
   @$nom=$_POST["nom"];
   @$prenom=$_POST["prenom"];
   @$email=$_POST["email"];
   @$role=$_POST["roles"];
   @$pass=$_POST["pass"];
   @$repass=$_POST["repass"];
   @$photo_tmp=$_FILES["photo"]["tmp_name"];
   @$photo=$_FILES["photo"]["name"];
   $valider=$_POST["valider"];
   $erreur="";
   $destination = 'profil/'.$photo;
   if(isset($valider)){
      if(empty($nom)) $erreur="Veuiller renseigner les champs obligatoires ‘ * ’!";
      elseif(empty($prenom)) $erreur="Prénom laissé vide!";
      elseif(empty($nom)) $erreur="Prénom laissé vide!";
      elseif(empty($email)) $erreur="email laissé vide!";
      elseif(empty($role)) $erreur="le role laissé vide!";
      elseif(empty($pass)) $erreur="Mot de passe laissé vide!";
      elseif($pass!=$repass) $erreur="Mots de passe non identiques!";
      else{
         include("connexion.php");
         $sel=$pdo->prepare("select id from utilisateurs where email=? limit 1");
         $sel->execute(array($email));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="le mail existe déjà!";
         else{
            $ins=$pdo->prepare("insert into utilisateurs(prenom,nom,email,roles,pass,photo) values (?,?,?,?,?,?)");
            $ins->execute(array($prenom,$nom,$email,$role,md5($pass),$photo));
            if ($ins) {
               move_uploaded_file($photo_tmp, $destination); 
            }
           
         
            $sql = "SELECT id FROM utilisateurs WHERE email = '".$email."'";
                $id = $pdo->prepare($sql);
                $id->execute();
                $row = $id->fetch(PDO::FETCH_ASSOC);
                //on modifie le matricule
                 $matricule = date('Y-', time()).$row['id'].'-BMB';
                //on modifie la derniere matricule du BD
                $sql2 = "UPDATE utilisateurs SET  matricule = '$matricule' WHERE email = '".$email."'";
                $matricule2 = $pdo->prepare($sql2);
                $matricule2->execute();
                
                /* $message3.="<label>Votre matricule est: '".$matricule."'</label>"; */
              /*  header("location:login.php"); */
         }
            
      }
   }
}
?>
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
         #role{
            border:solid 1px #00CA4D;
            width: 335px;
            height: 38px;
            border-radius:6px;
            background-color: white;
         }
         .erreur{
            color:#CC0000;
            margin-bottom:10px;
         }
      
         #submit{ 
         display:flex;
         justify-content: center;
         gap: 20px;
         
         }
         #inscription{
            border: solid #00CA4D ;
            height: 501px;
            width: 900px;
            border-radius: 10px;
          
         }
         #btn{
            height: 50px;
            width: 85px;
            background-color:#00A400;
            position: relative;
            left:86px;
            top:10px;
            justify-content:center;
            
         }
         label{
         color:#1996D3;
         display:flex;
         
         }
         #erreur2,#erreur,#erreur1,#erreur3,#erreur4,#erreur5{
          display: flex;
   
          height: 2px;;
            }
            .li{
           
            height: 90px;
            }
            #connexion{
               position: relative;
               top:25%;
            }
   
      </style>
   </head>
   <body>
    
      <center>
         <div id="inscription">
      <h1>Inscription</h1>
   <span id="erreur0"></span>
      <form  method="post" action="" name="formulaire" enctype="multipart/form-data" id="submit">

         <div id="ins1">
         <div class="li" >
         <label for="nom" >Nom <span style="color:red;">*</span></label>
         <input type="text" id="nom" name="nom" placeholder="Nom" /> 
         <span id="erreur1" ></span>
         </div>

 
         <div class="li" >
         <label for="email" >email <span style="color:red;">*</span></label>
         <input id="email" type="text" name="email" placeholder="mail@serveur.com" >
         <span id="erreur2" ></span>
         </div>
         

         <div class="li" >
         <label  for="pass">Mot de passe <span style="color:red;">*</span></label>
         <input id="mdp" type="password" name="pass" placeholder="Mot de passe"/>
         <span id="erreur4" ></span>
         </div>


      <div class="li" >
         <label for="photo">Profil</label>
         <input id="photo" type="file" name="photo" placeholder="Profil">
        </div>

         </div>
      <div id="ins2">
          <div class="li" >
         <label for="prenom">Prénom<span style="color:red;">*</span></label>
         <input id="prenom" type="text" name="prenom" placeholder="Prénom" >
         <span id="erreur" ></span>
      </div>

        <div class="li" >
         <label for="role">Rôle <span style="color:red;">*</span></label>
         <select name="roles"  id="role" >
                   <option value=""></option>
                  <option value="Admin">Admin</option>
                    <option value="Utilisateur">utilisateur</option>
      </select>
      <span id="erreur3" ></span>
         </div>


      <div class="li" >
         <label for="repass">Confirmer le mot de passe<span style="color:red;">*</span></label>
         <input id="cmdp" type="password" name="repass" placeholder="Confirmer Mot de passe" />
         <span id="erreur5" ></span>
      </div>
     
        <div class="li">
         <a href="login.php" id="connexion" >connexion</a>
         <input  id="btn" type="submit" name="valider"   value="S'inscrire"/>
      </div>
   </div>
      </form>
      </div>
      </center>
   </body>
   <script>
var submit = document.getElementById("submit");
submit.addEventListener("submit", function(e){
 
    let prenom = document.getElementById("prenom");
    if(prenom.value.trim() == ""){
        let erreur = document.getElementById("erreur");
        erreur.innerHTML = "Entrer un prenom";
        erreur.style.color = "red";    
        e.preventDefault();
    }
    else{
        erreur.innerHTML = "";
    }

    let nom = document.getElementById("nom");
    if(nom.value.trim() == ""){
        let erreur1 = document.getElementById("erreur1");
        erreur1.innerHTML = "Entrer un nom";
        erreur1.style.color = "red";
        e.preventDefault();
    }
    else{
        erreur1.innerHTML = "";
    }

    let email = document.getElementById("email");
    let mailformat = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
    if(email.value.trim() == ""){
        let erreur2 = document.getElementById("erreur2");
        erreur2.innerHTML = "Entrer un email";
        erreur2.style.color = "red";
        e.preventDefault();
    }
    else if(email.value.match(mailformat)){
        erreur2.innerHTML = "";
    }
    else{
        erreur2.innerHTML = "Email invalide";
        erreur2.style.color = "red";
        
    }

    let role = document.getElementById("role");
    if(role.value.trim() == ""){
        let erreur3 = document.getElementById("erreur3");
        erreur3.innerHTML = "Choisir un rôle";
        erreur3.style.color = "red";
        e.preventDefault();
    }
    else{
        erreur3.innerHTML = "";
    }

    let mdp = document.getElementById("mdp");
    if(mdp.value.trim() == ""){
        let erreur4 = document.getElementById("erreur4");
        erreur4.innerHTML = "Saisir mot de passe";
        erreur4.style.color = "red";
        e.preventDefault();
    }
    else{
        erreur4.innerHTML = "";
    }

    let cmdp = document.getElementById("cmdp");
    if(cmdp.value.trim() == ""){
        let erreur5 = document.getElementById("erreur5");
        erreur5.innerHTML = "Ressaisir mot de passe";
        erreur5.style.color = "red";
        e.preventDefault();
    }
    else if(cmdp.value.trim() !== mdp.value.trim()){
        erreur5.innerHTML = "Mots de passe non identiques";
        erreur5.style.color = "red";
        e.preventDefault();
    }
    else if(cmdp.value.trim() === mdp.value.trim()){
        erreur5.innerHTML = "";
    }  
});
/* let mdp = document.getElementById('mdp');
let i1 = document.getElementById('i1');
let i2 = document.getElementById('i2');
i2.style.display = 'none';
i1.addEventListener('click', function(){
    if(mdp.type === 'password'){
        mdp.type = 'text';
        i1.style.display = 'none';
        i2.style.display = 'block';
    }
})
i2.addEventListener('click', function(){
     if(mdp.type === 'text'){
        mdp.type = 'password';
        i1.style.display = 'block';
        i2.style.display = 'none';
    }
})

let cmdp = document.getElementById('cmdp');
let i3 = document.getElementById('i3');
let i4 = document.getElementById('i4');
i4.style.display = 'none';
i3.addEventListener('click', function(){
    if(cmdp.type === 'password'){
        cmdp.type = 'text';
        i3.style.display = 'none';
        i4.style.display = 'block';
    }
})
i4.addEventListener('click', function(){
     if(cmdp.type === 'text'){
        cmdp.type = 'password';
        i3.style.display = 'block';
        i4.style.display = 'none';
    }
}) */

</script>
   </html>
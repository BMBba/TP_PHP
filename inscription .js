let submit = document.getElementById("submit");
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
let mdp = document.getElementById('mdp');
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
})



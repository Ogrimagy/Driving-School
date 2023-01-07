
var tab = [0,0,0,0,0,0,0,0];
var age = 0;

function estUneLettre(car){
    if( ((car <= "a" && car != "a") || (car>="z" && car != "z")) && ((car <= "A" && car != "A") || (car>="Z" && car != "Z")))
        return false;
    else// <==> ((car > "a" || car == "a") && (car < "z" || car == "z")) ...
        return true;
}

function isPwPatt(car){
    if( ((car <= "a" && car != "a") || (car>="z" && car != "z")) && ((car <= "A" && car != "A") || (car>="Z" && car != "Z")) && ((car <= "0" && car != "0") || (car>="9" && car != "9"))){
        return false;

    }else 
        return true;
}

function verifier_nom(){
    var nom = document.getElementById("nom").value;
    var pattern = /^[a-zA-Z]{3,30}$/;
    
    if(nom == ""){
        document.getElementById("err_nom").textContent = "Le nom doit être renseigné";
        document.getElementById("nom").className = "erreurChamp";
        progression(0, -15);

    }else if(!pattern.test(nom)){
        document.getElementById("err_nom").textContent = "Le nom contient au moins 3 caractères alphabétiques";
        document.getElementById("nom").className = "erreurChamp";
        progression(0, -15);

    }else {
        document.getElementById("err_nom").textContent = "";
        document.getElementById("nom").className = "correcte";
        progression(0, 15);
        setTimeout('document.getElementById("nom").className = ""', 800);
    }
}

function verifier_prenom(){
    var prenom = document.getElementById("prenom").value;
    var pattern = /^[a-zA-Z]{3,30}$/;

    if(prenom == ""){
        document.getElementById("err_prenom").textContent = "Le prénom doit être renseigné";
        document.getElementById("prenom").className = "erreurChamp";
        progression(1, -15);

    }else if(!pattern.test(prenom)){
        document.getElementById("err_prenom").textContent = "Le prénom contient au moins 3 caractères alphabétiques";
        document.getElementById("prenom").className = "erreurChamp";
        progression(1, -15);

    }else{
        document.getElementById("err_prenom").textContent = "";
        document.getElementById("prenom").className = "correcte";
        progression(1, 15);
        setTimeout('document.getElementById("prenom").className = ""', 800);
    }
}

function verifier_dates(){
    var date_naissance = document.getElementById("naissance").value;
    var currentDate = new Date();

    if(date_naissance == ""){
        document.getElementById("err_naiss").textContent = "La date naissance doit être spécifiée";
        document.getElementById("naissance").className = "erreurChamp";
        progression(2, -15);

    }else{
        date_naissance = date_naissance.split("-")[0];// year
        currentDate = currentDate.getFullYear();
        var difference = currentDate - date_naissance;
        age = currentDate - date_naissance;
        if(difference < 18){
            document.getElementById("err_naiss").textContent = "Vous n'avez pas l'age autorisé(18 ans)";
            document.getElementById("naissance").className = "erreurChamp";
            progression(2, -15);

        }else{
            document.getElementById("err_naiss").textContent = "";
            document.getElementById("naissance").className = "correcte";
            progression(2, 15);
            setTimeout('document.getElementById("naissance").className = ""', 800);
        }
    }
}

function verifier_ville(){
    var ville = document.getElementById("ville").value;
    var pattern = /^[a-zA-Z]{4,30}$/;

    if(ville == ""){
        document.getElementById("err_ville").textContent = "Le nom de la ville doit être renseigné";
        document.getElementById("ville").className = "erreurChamp";
        progression(3, -15);

    }else if (!pattern.test(ville)){
        document.getElementById("err_ville").textContent = "Le nom de la ville contient au moins 4 caractères alphabétiques";
        document.getElementById("ville").className = "erreurChamp";
        progression(3, -15);

    }else{
        document.getElementById("err_ville").textContent = "";
        document.getElementById("ville").className = "correcte";
        progression(3, 15);
        setTimeout('document.getElementById("ville").className = ""', 800);
    }
}

function verifier_mail(){
    var pattern = /^[a-zA-Z0-9._]+@[a-zA-Z]+\.[a-zA-Z]{2,3}$/;
    var mail = document.getElementById("ad_email").value;

    if(mail == ""){
        document.getElementById("err_mail").textContent = "L'adresse E-mail doit être renseignée";
        document.getElementById("ad_email").className = "erreurChamp";
        progression(4, -15);

    }else if(!pattern.test(mail)){
        document.getElementById("err_mail").textContent = "L'email accepte les caractères alpha-numériques, les points et les '_'(expl: ab_D.1@doM1n.xYz)";
        document.getElementById("ad_email").className = "erreurChamp";
        progression(4, -15);

    }else{
        document.getElementById("err_mail").textContent = "";
        document.getElementById("ad_email").className = "correcte";
        progression(4, 15);
        setTimeout('document.getElementById("ad_email").className = ""', 800);
    }
}

function verifier_tel(){
    var tel = document.getElementById("phone").value;
    var pattern = /[0][5-7][0-9]{8}$/;
    
    if(tel == ""){
        document.getElementById("err_phone").textContent = "Le numéro de téléphone doit être renseigné";
        document.getElementById("phone").className = "erreurChamp";
        progression(5, -15);

    }else if(!pattern.test(tel)){
        document.getElementById("err_phone").textContent = "05/06/07 + 8 chiffres";
        document.getElementById("phone").className = "erreurChamp";
        progression(5, -15);

    }else{
        document.getElementById("err_phone").textContent = "";
        document.getElementById("phone").className = "correcte";
        progression(5, 15);
        setTimeout('document.getElementById("phone").className = ""', 800);
    }
}

function verifier_pw(){
    var pattern = /^[a-zA-Z0-9_]{4,}$/;
    var mdp = document.getElementById("mot_passe").value;

    if(mdp == ""){
        document.getElementById("err_pw").textContent = "Le mot de passe doit être renseignée";
        document.getElementById("mot_passe").className = "erreurChamp";
        progression(7, -15);

    }else if(!pattern.test(mdp)){
        document.getElementById("err_pw").textContent = "Le mot de passe contient au moins 4 caractères alpha-numériques('_' est autorisé)";
        document.getElementById("mot_passe").className = "erreurChamp";
        progression(7, -15);

    }else{
        document.getElementById("err_pw").textContent = "";
        document.getElementById("mot_passe").className = "correcte";
        setTimeout('document.getElementById("mot_passe").className = ""', 800);
        progression(7, 15);
    }
}

function progression(code, prog){

     if(tab[code]==0 && prog>0){
        document.getElementById("progression_inscription").value+=prog;
        prog>0? tab[code]=1 : tab[code]=-1;
    }
    else if( (tab[code]==-1 && prog>0) || (tab[code]==1 && prog<0)){
        document.getElementById("progression_inscription").value+=prog;
        prog>0? tab[code]=1 : tab[code]=-1;
    }
}


function initialiser(){
    document.getElementById("progression_inscription").value = 0;
    tab = [0,0,0,0,0,0,0];
    document.getElementById("err_nom").textContent = "";
    document.getElementById("err_prenom").textContent = "";
    document.getElementById("err_naiss").textContent = "";
    document.getElementById("err_ville").textContent = "";
    document.getElementById("err_mail").textContent = "";
    document.getElementById("err_phone").textContent = "";
    document.getElementById("err_pw").textContent = "";
}

function validateForm(){
    var nomPattern = /^[a-zA-Z]{3,30}$/;
    var villePattern = /^[a-zA-Z]{4,30}$/;
    var mailPattern = /^[a-zA-Z0-9._]+@[a-zA-Z0-9_]+\.[a-zA-Z]{2,3}$/;
    var telPattern = /[0][5-7][0-9]{8}$/;
    var mdpPattern = /^[a-zA-Z0-9_]{4,}$/;

    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("prenom").value;
    var ville = document.getElementById("ville").value;
    var ad_email = document.getElementById("ad_email").value;
    var phone = document.getElementById("phone").value;
    var pw = document.getElementById("mot_passe").value;

    if(nom == "" || prenom == "" || age<18 || ville == "" ||  ad_email == "" || phone == "" || pw == "" || 
        (!nomPattern.test(nom)) || (!nomPattern.test(prenom))  || (!villePattern.test(ville)) || (!mailPattern.test(ad_email)) || 
        (!telPattern.test(phone)) || (!mdpPattern.test(pw) )){

        document.getElementById("err_submit").textContent = "veuillez vérifier votre saisie";

    }else {
        document.getElementById("err_submit").textContent = "";
        return true;
    }
}
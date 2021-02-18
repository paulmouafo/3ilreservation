document.getElementById('inscription').addEventListener("submit", function (e){
    e.preventDefault();

    // Dans le cas ou on veut recupérer tous les données de notre form sans avoir a
    // faire le document.getElementById pour chaque input
    var data = new FormData(this);  // recupère automatic tous les entrées de notre form

    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            console.log(this.response);
            let res = this.response;
            if(res.success)
            {
                console.log("Utilisateur inscrit !");
                alert("Utilisateur inscrit !");
            }else
            {
                alert(res.msg);
            }
        }else if(this.readyState == 4)
        {
            alert("Une erreur est survenue...");
        }
    };

    xhr.open("POST", "../controller/signin.php", true);

    xhr.responseType = "json";

    // Envoie de la requette
    xhr.send(data);


    return false; // pour etre sur d'eviter le comportement par défaut
});
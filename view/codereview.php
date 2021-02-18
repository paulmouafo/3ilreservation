<?php
    session_start();

    $code=array($_POST['code0'],$_POST['code1'], $_POST['code2'], $_POST['code3'], $_POST['code4'],$_POST['code5']);
    $pseudo=$_POST['pseudo'];
    require_once ('../controller/connect.php');

function connectByCode($pseudo,$code){
    global $dbh;
    $req=$dbh->prepare('select * from utilisateur where login=:pseudo');
    $req->bindParam(':pseudo',$pseudo);
    $req->execute();
    $data=$req->fetchAll();
    if($data!=false){

        $codeBd=explode('-',$data[0]['code_secret']);
        if(password_verify($codeBd[0],$code[0]) &&
            password_verify($codeBd[1],$code[1])&&
            password_verify($codeBd[2],$code[2]) &&
            password_verify($codeBd[3],$code[3]) &&
            password_verify($codeBd[4],$code[4]) &&
            password_verify($codeBd[5],$code[5])){

            if($data[0]['role']=='etudiant'){
                $_SESSION['login'] = true;
                $_SESSION['role'] = 'etudiant';
                $_SESSION['idUtilisateur'] = $data[0]['id'];
                return 1;
                // le code 1 va m'aider à rediriger
                //l'utilisateur vers sa page en fonction de ses acces
            }
            elseif($data[0]['role']=='admin'){
                $_SESSION['role']=$data[0]['role']; $_SESSION['login'] = true;
                $_SESSION['role'] = 'admin';
                $_SESSION['idUtilisateur'] = $data[0]['id'];
                return 2;
            }

        }
        else{
            $_SESSION['role']='aucun';
            $_SESSION['login'] = false;
            $_SESSION['role'] = '';
            $_SESSION['idUtilisateur'] = '';
            return 3;

        }

    }
    else{
        $_SESSION['role']='aucun';
        $_SESSION['login'] = false;
        $_SESSION['role'] = '';
        $_SESSION['idUtilisateur'] = '';
        return 4;

    }


}
$page=connectByCode($pseudo,$code);
$data=array('page'=>$page, 'pseudo'=>$pseudo);
echo json_encode($data);


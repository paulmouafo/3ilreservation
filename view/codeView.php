<?php
session_start();
function shuffle_assoc(&$array) {
    $keys = array_keys($array);

    shuffle($keys);

    foreach($keys as $key) {
        $new[$key] = $array[$key];
    }

    $array = $new;

    return true;
}
$code=array('0'=>password_hash('AAB',PASSWORD_DEFAULT),
    '1'=>password_hash('BAD',PASSWORD_DEFAULT),
    '2'=>password_hash('ACD',PASSWORD_DEFAULT)
,'3'=>password_hash('ZKA',PASSWORD_DEFAULT)
,'4'=>password_hash('XZB',PASSWORD_DEFAULT)
,'5'=>password_hash('YCR',PASSWORD_DEFAULT)
,'6'=>password_hash('DGF',PASSWORD_DEFAULT)
,'7'=>password_hash('WMK',PASSWORD_DEFAULT)
,'8'=>password_hash('FVX',PASSWORD_DEFAULT)
,'9'=>password_hash('OYC',PASSWORD_DEFAULT)
);
shuffle_assoc($code);
$_SESSION['mdp']=$code;
?>
<!DOCTYPE html>
<html lang="en"  style="height:100%">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../stylesheet/login.css">
    <title>Code</title>
</head>
<body >


<section class="login-page">
    <div class="box">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="card" style="width: 20rem; opacity:0.8">
                <div class="card-body">
                    <h5 class="card-title text-center">Code secret</h5>

                    <div class="row">
                        <?php
                        $k=0;
                        for($i=0;$i<10;$i++){
                            ?>
                            <div class="col m-2"><button class="btn btn-secondary" onclick="saisir('<?=$code[array_keys($code)[$i]]?>')" ><?=array_keys($code)[$i]?></button></div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="row justify-content-around mt-3">
                        <div class="col-4"><a href="#" class="btn btn-primary" onclick="valider()">Valider</a></div>
                        <div class="col-4"><a href="#" class="btn btn-danger" onclick="effacer()">X</a></div>
                    </div>
                    <div class="form-group mt-2">
                        <input type="text" class="form-control" disabled id="codeV" >
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let code=[];
    let last=0;
    function saisir(hash){
        let pass=document.getElementById('codeV');
        code.push(hash);
        pass.setAttribute('value',pass.value + '*');
    }
    function effacer(){
        let pass=document.getElementById('codeV');
        let lastP=pass.value.length;
        last=code.length;
        if(lastP>0){
            lastP--;
        }
        if(last>0){
            last-=40;
        }
        code.pop();
        pass.setAttribute('value',pass.value.substring(0,lastP));
    }
    function valider(){
        var data=new FormData();
        data.set("code0",code[0]);
        data.set("code1",code[1]);
        data.set("code2",code[2]);
        data.set("code3",code[3]);
        data.set("code4",code[4]);
        data.set("code5",code[5]);
        data.set("pseudo",`<?=$_GET['pseudo']?>`);
        axios({
            method:'post',
            url:'codereview.php',
            data:data
        }).then((response)=>{
            let page=response.data.page;
            switch (page){
                case 1:
                    document.location.href='index2.php';
                    break;
                case 2:
                    document.location.href='index2.php';
                    break;
                case 3:
                    document.location.href='codeView.php?pseudo='+response.data.pseudo;
                    break;
                case 4:
                    document.location.href='pseudo.php';
                    break;

            }


        }).catch((error)=>console.error(error))
    }

</script>
</body>
</html>
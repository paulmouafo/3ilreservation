<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../stylesheet/login.css">
    <title>Input</title>
</head>
<body>
<section class="login-page">

<div class="box">
    <div class="form-head">
        <h2> Member Login</h2>
    </div>
    <div class="form-body">
        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
    </div>
    <div class="form-footer">
        <button type="submit" name="suivant" id="sub">Suivant</button>

    </div>

</div>


<script>
    let sub= document.getElementById('sub');
    sub.onclick=function(e){
        document.location.href='codeView.php?pseudo='+document.getElementById('pseudo').value;
    }
</script>
</section>
</body>
</html>
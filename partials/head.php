<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <title>Keskusteluforum</title>
</head>
<body>
<a href='/'><h1>Keskustelu forum</h1></a>

<?php if(isLoggedIn()){?>
    <?= $_SESSION['username']?><br>
    <a href='/logout'>Kirjaudu ulos</a><br>
<?php }else{?>
    <a href='/register'>rekisteröidy</a><br>
    <a href='/login'>kirjaudu sisään</a>
<?php }?>
<hr/>
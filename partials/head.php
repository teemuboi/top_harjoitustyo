<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <title>Keskusteluforum</title>
</head>
<body>
<header>
    <h1 class="title"><a href='/'>Keskustelu forum</a></h1>
    <div class="usermenu">
    <?php if(isLoggedIn()){?>
        <u><?= $_SESSION['username']?></u><br>
        <a href='/logout'>Kirjaudu ulos</a><br>
    <?php }else{?>
        <a href='/register'>rekisteröidy</a><br>
        <a href='/login'>kirjaudu sisään</a>
    <?php }?>
    </div>
</header>
<!-- <hr/> -->
<div class="pageview">
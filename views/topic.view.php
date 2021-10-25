<h1><?= $topic[0]["title"]?></h1>

<?php if(isLoggedIn()){?>
<form method="post">
    Post message<br>
    <input type="text" name="text" placeholder="text" maxlength=250 required>
    <input type="submit" value="Post">
</form>
<?php }?>

<table>
<?php foreach ($messages as $message) {?>
    <tr>
        <th>
            <?=$message["text"]?>
        </th>
        <th>
            <?=getUser($message["userid"])[0]["username"]?><br>
            <?=$message["date"]?>
        </th>
    </tr>
<?php }?>
</table>
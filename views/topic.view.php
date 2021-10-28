<h1><?= $topic[0]["title"]?></h1>

<?php if(isLoggedIn()){?>
<form method="post">
    Post message<br>
    <input type="text" name="text" placeholder="text" maxlength=250 required>
    <input type="submit" value="Post">
</form>
<?php }?>

<table class="viewtopic">
<?php foreach ($messages as $message) {?>
    <tr>
        <td class="text">
            <?=$message["text"]?>
        </td>
        <td class="info">
            <?php if(isLoggedIn() && $_SESSION['userid'] == $message["userid"]){?>
                <a href='/editmessage?messageid=<?= $message["messageid"]?>'>edit</a> 
                <a href='/deletemessage?messageid=<?= $message["messageid"]?>'>delete</a><br>
            <?php }?>

            <b><?=getUser($message["userid"])[0]["username"]?></b><br>
            <?=$message["date"]?>
        </td>
    </tr>
<?php }?>
</table>
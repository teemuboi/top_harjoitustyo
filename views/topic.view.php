<a href='/'>
    go back
</a>
<h2><?= $topic[0]["title"]?></h2>

<?php if(isLoggedIn()){?>
<form method="post">
    Post message<br>
    <!-- <input type="text" name="text" placeholder="text" maxlength=2000 required> -->
    <textarea name="text" rows="6" cols="80" maxlength=2000 required></textarea><br>
    <input type="submit" value="Post">
</form>
<?php }?>

<table class="viewtopic">
<?php foreach ($messages as $message) {?>
    <tr>
        <td class="text">
            <?=nl2br($message["text"])?>
        </td>
        <td class="info">
            <b><?=getUser($message["userid"])[0]["username"]?></b><br>
            <?=$message["date"]?><br>
            <?php if(isLoggedIn() && $_SESSION['userid'] == $message["userid"] || isAdmin()){?>
                <a href='/editmessage?messageid=<?= $message["messageid"]?>'>edit</a> 
                <a href='/deletemessage?messageid=<?= $message["messageid"]?>'>delete</a>
            <?php }?>
        </td>
    </tr>
<?php }?>
</table>
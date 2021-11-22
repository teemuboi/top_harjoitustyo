<a href='/'>
    go back
</a>
<h1><?= $topic["title"]?></h1>

<?php if(isLoggedIn()){?>
<form method="post">
    Post message<br>
    <!-- <input type="text" name="text" placeholder="text" maxlength=2000 required> -->
    <textarea name="text" rows="6" cols="80" maxlength=2000 required></textarea><br>
    <input type="submit" value="Post">
</form>
<?php }?>

<?php if(isset($page)){
if($page-1 != 0){
    if($page-1 != 1){?>
        <a href='/topic?topicid=<?=$_GET["topicid"]?>&page=1'>
            1
        </a>
    <?php }?>

    <a href='/topic?topicid=<?=$_GET["topicid"]?>&page=<?=$page-1?>'>
        <
    </a>
<?php }?>
<?=$page?>
<?php if($page*$maxpage < $messagescount){?>
    <a href='/topic?topicid=<?=$_GET["topicid"]?>&page=<?=$page+1?>'>
        >
    </a>

    <?php if($page+1 != ceil($messagescount/$maxpage)){?>
    <a href='/topic?topicid=<?=$_GET["topicid"]?>&page=<?=ceil($messagescount/$maxpage)?>'>
        <?=ceil($messagescount/$maxpage)?>
    </a>
<?php }}}?>

<table class="viewtopic">
<?php foreach ($messages as $message) {?>
    <tr>
        <td class="text"><i class="username"><?=getUser($message["userid"])["username"]?> <?=dateConvert($message["date"])?></i><div class="content"><?=censor_input(htmlentities($message["text"]))?></div></td>
        <td class="info">
            <?php if(isLoggedIn() && $_SESSION['userid'] == $message["userid"] || isAdmin()){?>
                <?php if($_SESSION['userid'] == $message["userid"] || !isAdmin()){?>
                    <a href='/editmessage?messageid=<?=$message["messageid"]?>'>edit</a>
                <?php }?>
                <a href='/deletemessage?messageid=<?=$message["messageid"]?>'>delete</a>
            <?php }else{?>
                <br>
            <?php }?>
        </td>
        <td class="vote">
            <a <?=votedStyle($message["messageid"], 1)?> href='/vote?messageid=<?=$message["messageid"]?>&vote=upvote'>▲</a><br>
            <?=countMessageVotes($message["messageid"])?><br>
            <a <?=votedStyle($message["messageid"], -1)?> href='/vote?messageid=<?=$message["messageid"]?>&vote=downvote'>▼</a>
        </td>
    </tr>
<?php }?>
</table>
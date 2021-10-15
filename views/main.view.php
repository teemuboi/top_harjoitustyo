<?php if(isLoggedIn()){?>
<form method="post">
    Create a topic<br>
    <input type="text" name="title" placeholder="title" maxlength=30 required>
    <input type="submit" value="Post">
</form>
<?php }?>

<h1>Etusivu</h1>

<table>
<?php foreach ($topics as $topic) {?>
    <tr>
        <th>
            <a href='/topic?topicid=<?= $topic["topicid"]?>'>
                <?=$topic["title"]?>
            </a>
        </th>
        <th>
            creator: <?=getUser($topic["userid"])[0]["username"]?><br>
            <?php
                if(getAllMessages($topic["topicid"])){
            ?>
                latest: <?=getAllMessages($topic["topicid"])["0"]["date"]?>
            <?php }else{?>
                created: <?=$topic["date"]?>
            <?php }?>
            <br>
            <?= count(getAllMessages($topic["topicid"]))?> posts
        </th>
    </tr>
<?php }?>
</table>
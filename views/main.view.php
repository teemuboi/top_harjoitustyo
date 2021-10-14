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
            <?= count(getAllMessages($topic["topicid"]))?> posts
        </th>
        <th>
            tekijä: <?=getUser($topic["userid"])[0]["username"]?><br>
            date
        </th>
    </tr>
<?php }?>
</table>
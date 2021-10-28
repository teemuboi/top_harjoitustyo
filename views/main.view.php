<?php if(isLoggedIn()){?>
<form method="post">
    Create a topic<br>
    <input type="text" name="title" placeholder="title" maxlength=30 required>
    <input type="submit" value="Post">
</form>
<?php }?>

<h1>Etusivu</h1>

<table class="maintopics">
    <th>Topics</th><th>Posts</th>
<?php foreach ($topics as $topic) {?>
    <tr>
        <td class="topics">
            <a href='/topic?topicid=<?=$topic["topicid"]?>'>
                <b><?=$topic["title"]?></b>
            </a><br>
            creator: <b><?=getUser($topic["userid"])[0]["username"]?></b>
        </td>
        <td class="posts">
            <?=count(getAllMessages($topic["topicid"]))?> posts
        </td>
        <td class="date">
            <?php if(isLoggedIn() && $_SESSION['userid'] == $topic["userid"]){
            if(!getAllMessages($topic["topicid"])){?>
                <a href='/edittopic?topicid=<?= $topic["topicid"]?>'>edit</a> 
            <?php }?>
                <a href='/deletetopic?topicid=<?= $topic["topicid"]?>'>delete</a><br>
            <?php }?>
            
            <?php if(getAllMessages($topic["topicid"])){?>
                latest: <?=getAllMessages($topic["topicid"])["0"]["date"]?>
            <?php }else{?>
                created: <?=$topic["date"]?>
            <?php }?>
        </td>
    </tr>
<?php }?>
</table>
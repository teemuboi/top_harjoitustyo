<h1>Etusivu</h1>
<?php if(isLoggedIn()){?>
<form method="post">
    Create a topic<br>
    <input type="text" name="title" placeholder="title" maxlength=100 required>
    <input type="submit" value="Post">
</form>
<?php }?>

<table class="maintopics">
    <th>Topics</th><th>Posts</th>
<?php foreach ($topics as $topic) {?>
    <tr>
        <td class="topics">
            <a href='/topic?topicid=<?=$topic["topicid"]?>'>
                <b><?=$topic["title"]?></b>
            </a><br>
            <i>creator: <?=getUser($topic["userid"])[0]["username"]?></i>
        </td>
        <td class="posts">
            <?=count(getAllMessages($topic["topicid"]))?> posts
        </td>
        <td class="date">
            <?php if(getAllMessages($topic["topicid"])){?>
                latest: <?=getAllMessages($topic["topicid"])["0"]["date"]?>
            <?php }else{?>
                created: <?=$topic["date"]?>
            <?php }?><br>

            <?php if(isLoggedIn() && $_SESSION['userid'] == $topic["userid"] || isAdmin()){
            if(!getAllMessages($topic["topicid"]) || isAdmin()){?>
                <a href='/edittopic?topicid=<?= $topic["topicid"]?>'>edit</a> 
            <?php }?>
                <a href='/deletetopic?topicid=<?= $topic["topicid"]?>'>delete</a>
            <?php }?>
        </td>
    </tr>
<?php }?>
</table>
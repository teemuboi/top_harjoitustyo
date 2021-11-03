<h1>Etusivu</h1>
<?php if(isLoggedIn()){?>
<form method="post">
    Create a topic<br>
    <input type="text" name="title" placeholder="title" maxlength=100 required>
    <input type="submit" value="Post">
</form>
<?php }?>

<?php if($page-1 != 0){
    if($page-1 != 1){?>
        <a href='/?page=1'>
            1
        </a>
    <?php }?>

    <a href='/?page=<?=$page-1?>'>
        <
    </a>
<?php }?>

<?=$page?>

<?php if($page*$maxpage <= $topiccount){?>
    <a href='/?page=<?=$page+1?>'>
        >
    </a>

    <?php if($page+1 != ceil($topiccount/$maxpage)){?>
    <a href='/?page=<?=ceil($topiccount/$maxpage)?>'>
        <?=ceil($topiccount/$maxpage)?>
    </a>
<?php }}?>

<table class="maintopics">
    <th>Topics</th><th>Posts</th><th></th>
<?php foreach ($topics as $topic) {?>
    <tr>
        <td class="topics">
            <a href='/topic?topicid=<?=$topic["topicid"]?>'>
                <b><?=$topic["title"]?></b>
            </a><br>
            <i>creator: <?=getUser($topic["userid"])["username"]?></i>
        </td>
        <td class="posts">
            <?=count(getAllMessages($topic["topicid"]))?> posts
        </td>
        <td class="info">
            <div class="date">
                <?php if(getAllMessages($topic["topicid"])){?>
                    latest: <?=getAllMessages($topic["topicid"])["0"]["date"]?>
                <?php }else{?>
                    created: <?=$topic["date"]?>
                <?php }?><br>

                last modified: <?=$topic["lastmodified"]?><br>
            </div>

            <?php if(isLoggedIn() && $_SESSION['userid'] == $topic["userid"] || isAdmin()){
            if(!getAllMessages($topic["topicid"]) || isAdmin()){?>
                <a href='/edittopic?topicid=<?= $topic["topicid"]?>'>edit</a> 
            <?php }?>
                <a href='/deletetopic?topicid=<?= $topic["topicid"]?>'>delete</a>
            <?php }else{?>
                <br>
            <?php }?>
        </td>
    </tr>
<?php }?>
</table>
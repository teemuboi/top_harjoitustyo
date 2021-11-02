<a href='/'>
    go back
</a>
<h2>Edit topic: <u><?=$topic["title"]?></u></h2>
Date created: <?=$topic["date"]?><br>
Created by: <?=getUser($topic["userid"])["username"]?><br>
Number of posts: <?=count(getAllMessages($topic["topicid"]))?><br>
Last modified: <?=$topic["lastmodified"]?><br>
Last modified by: <?=getUser($topic["modifiedby"])["username"]?><br><br>
<form method="post">
    Edit title<br>
    <input type="text" name="title" placeholder="title" maxlength=30 value="<?=$topic["title"]?>" required autofocus>
    <input type="submit" value="edit">
</form>
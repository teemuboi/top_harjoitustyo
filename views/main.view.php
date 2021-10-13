<?php if(isLoggedIn()){?>
<form method="post">
    Create a topic<br>
    <input type="text" name="title" placeholder="title" maxlength=30 required>
    <input type="submit" value="Post">
</form>
<?php }?>

<h1>Etusivu</h1>

<?php foreach ($topics as $topic) {?>
    <a href='/topic?topicid=<?= $topic["topicid"]?>'><?=$topic["title"]?></a><br>
<?php }?>
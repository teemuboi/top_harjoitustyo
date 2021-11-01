<a href='/topic?topicid=<?=$message["topicid"]?>'>
    go back to <b><?=getTopic($message["topicid"])["title"]?></b>
</a>
<h1>Edit message</h1>
<form method="post">
    <textarea name="text" rows="6" cols="80" maxlength=2000 required autofocus><?=$message["text"]?></textarea><br>
    <input type="submit" value="edit">
</form>
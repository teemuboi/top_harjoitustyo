<a href='/topic?topicid=<?=$message[0]["topicid"]?>'>
    go back to <b><?=getTopic($message[0]["topicid"])[0]["title"]?></b>
</a>
<h1>Edit message</h1>
<form method="post">
    <textarea name="text" rows="6" cols="80" maxlength=2000 required><?=$message[0]["text"]?></textarea><br>
    <input type="submit" value="edit">
</form>
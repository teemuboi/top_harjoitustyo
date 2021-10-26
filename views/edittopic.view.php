<h1>Edit <u><?=$topic[0]["title"]?></u></h1>
<form method="post">
    Edit topic<br>
    <input type="text" name="title" placeholder="title" maxlength=30 value="<?=$topic[0]["title"]?>" required>
    <input type="submit" value="edit">
</form>
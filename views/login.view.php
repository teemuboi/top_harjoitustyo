<h1>Login</h1>
<?php
if(isset($result) && $result == false){
    echo "Wrong username or password";
}
?>
<form method="post">
    <input type="text" name="username" placeholder="username" maxlength=30 required><br>
    <input type="password" name="password" placeholder="password" maxlength=30 required><br>
    <input type="submit" value="Login">
</form>
<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
    header("Location: index.php");
}

if(isset($_POST['btn-login']))
{
    $email = mysql_real_escape_string($_POST['email']);
    $upass = mysql_real_escape_string($_POST['pass']);

    $email = trim($email);
    $upass = trim($upass);

    $res=mysql_query("SELECT user_id, username, password, priviledge FROM users WHERE email='$email'");
    $row=mysql_fetch_array($res);

    $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

    if($count == 1 && $row['password']==md5($upass) && $row['priviledge'] =="ADMIN")
    {
        $_SESSION['user'] = $row['user_id'];
        header("Location: index.php");
    }
	elseif($count == 1 && $row['priviledge'] !="ADMIN")
    {
        ?>
        <script>alert('Please log in with Administrative account');</script>
        <?php
    }
    else
    {
        ?>
        <script>alert('Username / Password Seems Wrong');</script>
        <?php
    }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login-Chrysaour Security</title>
    <link rel="stylesheet" href="styles/login.css" type="text/css" />
</head>
<body>
<center>
    <div id="login-form">
        <form method="post">
            <table align="center" width="30%" border="0">
                <tr>
                    <td><input type="text" name="email" placeholder="Email" required /></td>
                </tr>
                <tr>
                    <td><input type="password" name="pass" placeholder="Password" required /></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn-login">Sign In</button></td>
                </tr>
            </table>
        </form>
    </div>
</center>
</body>
</html>
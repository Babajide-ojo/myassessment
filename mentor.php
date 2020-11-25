<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Sign Up page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    require('dbConnection.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `user` (username, email, password, datetime)
                     VALUES ('$username', '$email','" . md5($password) . "', '$datetime')";
       $result   = mysqli_query($con, $query);
       if ($result) {
           echo "<div class='form'>
                 <h3>You are registered successfully.</h3><br/>
                 <p class='link'>Click here to <a href='login.php'>Login</a></p>
                 </div>";
       } else {
           echo "<div class='form'>
                 <h3>Required fields are missing.</h3><br/>
                 <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                 </div>";
       }
   } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
    <?php
   }
?>
</body>

</html>
<html>
<head>
<title>Ryan Donaldson CSC155 001DR Survey Thing</title>
<!--rdonaldson6-->
<link rel='stylesheet' type='text/css' href='style.css'>
<?php

require ('library/functions.php');

// depending on the zone, call one of
checkAccount("none");
//checkAccount("user");
//checkAccount("admin");
 
   $conn = getDBConnection();
    
    if (isset($_POST['selection']))
{
    if ($_POST['selection'] == 'Login')
    {
        if (checkAndStoreLogin($conn, $_POST['username'], $_POST['password']))
        {
            header('Location: home.php');
        }
        else
        {
            displayError("Login Failed");
        }
    }
    else if ($_POST['selection'] == 'Create Account')
    {
        header("Location: createAccount.php");
    }
}

    
?>
</head>
<body>
<h1>This is the welcome page for our project <br>  If you don't have an account, you can create one <a href="http://www.csit.parkland.edu/~rdonaldson6/csc155-cgi/Class_Website_Project/createAccount.php">here</a><br>
This is where you can see the account database over the web <a href="http://www.csit.parkland.edu/~rdonaldson6/csc155-cgi/Class_Website_Project/showAccounts.php">here</a>
</h1>

<div class="form">
        <form class="form-style-4" id="form" method="POST">
            <label for='Username'>Username:</label>
            <input type='text' id='Username' name='Username' value='<?php echo showPost("Username")?>' required autofocus><br>

            <label for='password'>Password:</label>
            <input type='password' id='password' name='password' value='<?php echo showPost("password")?>' required ><br>

            <input type="submit" name="selection" value="Login">
            <input type="submit" name="selection" value="Cancel">
        </form>
        </div>

<?php
//     User table test
//     printUserTable($conn); 
?>
</body>


<?php  require "header.php" ?>


<!-- </head> -->

<?php // depending on the zone, call one of
checkAccount("none");
//checkAccount("user");
//checkAccount("admin"); 
    
    $conn = getDBConnection();
    
    if (isset($_POST['selection']))
{
    if ($_POST['selection'] == 'Login')
    {
        if (checkAndStoreLogin($conn, $_POST['username'], $_POST['password'])){
           
            
            switch($_SESSION['usergroup']){
                case  user:
                    header('Location: home.php');
                    break;
                case  admin:
                    header('Location: admin.php');
                    break;
                case  su:
                    header('Location: su.php');
                    break;
            }
            //header('Location: home.php');
        }else{
            displayError("Login Failed");
        }
    }
    else if ($_POST['selection'] == 'Create Account'){
        header("Location: createAccount.php");
    }
}   
?>

<body>
<h1>This is the welcome page for our project <br>  If you don't have an account, you can create one <a href="http://www.csit.parkland.edu/~rdonaldson6/csc155-cgi/Class_Website_Project/createAccount.php">here</a><br>
This is where you can see the account database over the web <a href="http://www.csit.parkland.edu/~rdonaldson6/csc155-cgi/Class_Website_Project/showAccounts.php">here</a>
</h1>

<div class="form">
        <form class="form-style-4" id="form" method="POST">
            <label for='username'>Username:</label>
            <input type='text' id='username' name='username' value='<?php echo showPost("username")?>' autofocus><br>

            <label for='password'>Password:</label>
            <input type='password' id='password' name='password' value='<?php echo showPost("password")?>'  ><br>
            <input type="submit" name="selection" value="Login">
             <input type="submit" name="selection" value="Create Account">
        </form>
        </div>
        
<?php
//     User table test
//     printUserTable($conn); 
?>
</body>
<?php  require "footer.php" ?>
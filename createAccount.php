<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <link rel='stylesheet' type='text/css' href='formStyle.css'>
    <link rel="stylesheet" type="text/css" href="library/style.css">
</head>
<body>
<!--  kjlljdfsg-->
   <?php
    require ('library/functions.php');
    $conn = getDBConnection();
    
    if (isset($_POST['selection'])) // form loaded itself
    {

    if ($_POST['selection'] == "Create Account") // insert new record chosen
    {
        // Loop through database to check for duplicate username
        $sql = "SELECT * FROM rdonaldson6.users;";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                if($_POST["Username"] == $row["username"]){
                    displayError("Username taken");
                }else{    
                    //check for matching passwords double check
                    if ($_POST['password'] != $_POST['password2']){
                        displayError("Passwords don't match");   
                    }else{
                        // Prepare the SQL Statement 
                        $stmt = $conn->prepare("INSERT INTO users                (username, first_name,last_name,encrypted_password, usergroup, email) VALUES (?, ?, ?, ?, ?, ?)" );

                        //Bind Parameters to previous statement
                        // "ssssss" is a format string
                        $stmt->bind_param("ssssss", $username, $first_name, $last_name, $encrypted_password, $usergroup, $email);

                        // Set variables that are binded
                        $username=$_POST['Username'];
                        $first_name=$_POST['firstname'];
                        $last_name=$_POST['lastname'];
                        $encrypted_password=password_hash($_POST['password'],
                                                          PASSWORD_DEFAULT);
                        $usergroup=$_POST['user_group'];
                        $email=$_POST['email'];

 /*====================================================
     Execute the sql statement
 =====================================================*/
                        $stmt->execute();
                        header("Location: welcome.php");
            }
        }
            }
        }
    }
        if ($_POST['selection'] == "Cancel")
        {
            header("Location: welcome.php");
        }
    }

    ?>
<!--====================================================             START OF FORM
==================================================== -->
       <div class="form">
        <form class="form-style-4" id="form" method="POST">
            <label for='Username'>Username:</label>
            <input type='text' id='Username' name='Username' value='<?php echo showPost("Username")?>' required autofocus><br>

            <label for='firstname'>First name:</label>
            <input type='text' id='firstname' name='firstname' 
            value='<?php echo showPost("firstname")?>' ><br>

            <label for='lastname'>Last name:</label>
            <input type='text' id='lastname' name='lastname'  value='<?php echo showPost("lastname")?>'><br>

            <label for='password'>Password:</label>
            <input type='password' id='password' name='password' value='<?php echo showPost("password")?>' required ><br>

            <label for='password2'>Confirm password:</label>
            <input type='password' id='password2' name='password2' value='<?php echo showPost("password2")?>' required><br>

            <label for='email'>Email:</label>
            <input type='text' id='email' name='email' value='<?php echo showPost("email")?>' ><br>
            
            <p>User group:</p>
            <input type="radio" id="user" name="user_group"  value="user" <?php if(isset($_POST['user_group'])){echo 'checked="checked"';}?> checked>
            <label for="user">User</label><br>
            <input type="radio" id="admin" name="user_group" value="admin" <?php if(isset($_POST['user_group']) ){echo 'checked="checked"';}?>>
            <label for="admin">Admin</label><br>
            <input type="radio" id="su" name="user_group" value="admin" <?php if(isset($_POST['user_group']) ){echo 'checked="checked"';}?>>
            <label for="admin">Su</label><br>
            

            <input type="submit" name="selection" value="Create Account">
            <input type="submit" name="selection" value="Cancel">
        </form>
        </div>
        
        <?php
        // ==========================================
        //  User table test
        // ==========================================
        echo "<h1>For Easy Checking</h1>";
        printUserTable($conn); 
        ?>
</body>
</html>
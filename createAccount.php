<?php  require "header.php" ?>
<body>

   <?php
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
                        //  address1,address2, city, state, zipcode
                        // 12
                        $stmt = $conn->prepare("INSERT INTO users (username,first_name,last_name,encrypted_password,usergroup,email,created,address1,address2, city, state, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" );
                        
                        // mistake here??
                        //Bind Parameters to previous statement
                        // "ssssssisssi" is a format string
                        $stmt->bind_param("sssssssssssi", 
                                          $username, 
                                          $first_name, 
                                          $last_name, $encrypted_password, $usergroup, 
                                          $email,
                                          $created,
                                          $address1,
                                          $address2, 
                                          $city, 
                                          $state,
                                          $zipcode);

                        // Set variables that are binded
                        $username=$_POST['Username'];
                        $first_name=$_POST['firstname'];
                        $last_name=$_POST['lastname']; $encrypted_password=password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $usergroup=$_POST['user_group'];
                        $email=$_POST['email'];
                        $created=date('Y/m/d h:i:s', time());
                        $address1=$_POST['address1'];
                        $address2=$_POST['address2'];
                        $city=$_POST['city'];
                        $state=$_POST['state'];
                        $zipcode=$_POST['zipcode'];
                        
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
<!--====================================================            
 START OF FORM
==================================================== -->
       <div class="form">
        <form class="formClass"  method="POST">
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
            <div class="radioContainer">
            
                   <ul class="btn_radio">
                        <li><input type="radio" id="user" class="radio" name="user_group"  value="user" <?php if(isset($_POST['user_group'])){echo 'checked="checked"';}?> checked>
                            <label class="radio" for="user">User</label><br></li>

                        <li><input type="radio" id="admin" class="radio" name="user_group" value="admin" <?php if(isset($_POST['user_group']) ){echo 'checked="checked"';}?>>
                            <label class="radio" for="admin">Admin</label><br></li>

                        <li><input type="radio" id="su" class="radio" name="user_group" value="su" <?php if(isset($_POST['user_group']) ){echo 'checked="checked"';}?>>
                        <label class="radio" for="su">Su</label><br></li>
                    </ul>
                
            </div>
<!-- =========================================
            New Fields for 20-060
            address1,address2, city, state, zipcode
============================================-->
            <label for='address1'>Address 1:</label>
            <input type='text' id='address1' name='address1' value='<?php echo showPost("address1")?>' ><br>
            
            <label for='address2'>Address 2:</label>
            <input type='text' id='address2' name='address2' value='<?php echo showPost("address2")?>' ><br>
            
             <label for='city'>City:</label>
            <input type='text' id='city' name='city' value='<?php echo showPost("city")?>' ><br>
            
             <label for='state'>State:</label>
            <input type='text' id='state' name='state' value='<?php echo showPost("state")?>' ><br>
            
            <label for='zipcode'>Zipcode:</label>
            <input type='text' id='zipcode' name='zipcode' value='<?php echo showPost("zipcode")?>' ><br>
<!--                  End of new fields                 -->
           
           
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
<?php  require "footer.php" ?>
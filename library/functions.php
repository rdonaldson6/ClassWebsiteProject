<?php
/*============================================================
    Check for access
============================================================*/
function checkAccount($zone)
{
    // zone is either 'user' or 'admin', anything else is considered 
    // 'none' or publicly accessible
    
    // User
      if ($zone == 'user')
    {
        if (!isset($_SESSION['username']))
        {
            header('Location: welcome.php');
        }
    }

    
    // Admin
     if ($zone == 'admin')
    {
        if (!isset($_SESSION['username']))
        {
            header('Location: welcome.php');
        }
        if ($_SESSION['usergroup'] != 'admin')
        {
            header('Location: welcome.php');
        }
    }

}
/*============================================================
    Connect to Database
============================================================*/
function getDBConnection()                                                               
{                                                                   $servername = "localhost";
    $username = "rdonaldson6";
    $password = "rdonaldson6";
    $dbname = "rdonaldson6";                                                                                        
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);                     
                                                                                         
    // Check connection and shutdown if broken                                           
    if (mysqli_connect_errno()) {                                                        
        die("<b>Failed to connect to MySQL: " . mysqli_connect_error() . "</b>");        
    }                                                                                    
                                                                                         
    return $conn;                                                                        
}    

/*============================================================
    Error Message
============================================================*/
function displayError($mesg)
{
    echo "<div id='errorMessage'>";
    echo $mesg;
    echo "</div>";
}

/*============================================================
    Keep from re-entering data
============================================================*/
function showPost( $name )
{
# check to see if it been used, if it has, return it
    if ( isset($_POST[$name]) ) 
    {
        return $_POST[$name];
    }
    return "";
}

/*============================================================
    Print the Database
============================================================*/
function printUserTable($conn){
    $sql = "SELECT * FROM rdonaldson6.users;";
    $result = $conn->query($sql);
    echo "<br>";
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Username</th>";
    echo "<th>Name</th>";
    echo "<th>E-mail</th>";
    echo "<th>Encrypted Password</th>";
    echo "<th>User Group</th>";
    echo "</tr>";
    if ($result->num_rows > 0)
    {
        // Loop through db
        while ($row = $result->fetch_assoc()){
        echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["username"]."</td>";
            echo "<td>".$row["first_name"]." ".$row["last_name"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td>".$row["encrypted_password"]."</td>";
            echo "<td>".$row["usergroup"]."</td>";
        echo "<tr>";
        }
    }
    else{
        echo "<tr><td>0 Results</td></tr>";
    }
    echo "</table>";
}

/*============================================================
    Login
============================================================*/
function checkAndStoreLogin( $conn, $usernameToTest, $passwordToTest )
{
    $result=lookupUserName($conn, $usernameToTest);
    if ($result != FALSE)
    {
        $row = $result->fetch_assoc();
        $encrpytedFromDB = $row['encrypted_password'];
        if ( password_verify($passwordToTest, $encrpytedFromDB) )
        {
            $_SESSION['username'] = $row['username'];
            $_SESSION['usergroup'] = $row['usergroup'];
            return TRUE;
        }
    }
    return FALSE;
}

function lookUpUserName($conn, $usernameToFind){
    
       $sql = "SELECT * FROM users WHERE username=? ;"; // SQL with parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usernameToFind);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows == 1) {
            return $result;
        }
        else {
            return FALSE;
        }
}


?>

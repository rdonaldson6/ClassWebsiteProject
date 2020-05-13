<?php  require "header.php" ?>
<body>
    <?php
    //checkAccount("none");
    //checkAccount("user");
    checkAccount("admin");
    echo "<p>Hello Admin,".$_SESSION['username']."</p>" ?>
     <p> <a href="http://www.csit.parkland.edu/~rdonaldson6/csc155-cgi/Class_Website_Project/modifyAccount.php">Modify Account</a> </p>
    <p> 
    <a href="http://www.csit.parkland.edu/~rdonaldson6/csc155-cgi/Class_Website_Project/showAccounts.php">Check Accounts</a>
    </p>
</body>
<?php  require "footer.php" ?>
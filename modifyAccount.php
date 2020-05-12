<?php  require "header.php" ?>
<?php
// depending on the zone, call one of
//checkAccount("none");
//checkAccount("user");
checkAccount("admin");
?>
<body>
<?php printUserTable($conn); ?>
</body>
<?php  require "footer.php" ?>
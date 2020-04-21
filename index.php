<?php
session_start();
?>
<html>
<body>
<?php
    $Id = $_SESSION['id'];
    include 'database/db.php'; //database connection
    $sql = "SELECT * FROM users WHERE id = '$Id'";
           $result = mysqli_query($connection, $sql);
           $row = mysqli_fetch_array($result);
   echo $Id;

?>
<div style="margin: auto; width: 600px; ">
   <p style="color: blue; font-size: 19px;">Welcome  <?php echo $row['username'];?> </p>
    <a class="btn btn-danger" href="change-password.php">Change password</a><br/>
    <br/>
    <a href="update-profile.php">update</a>

</div>
</body>
</html>
<?php
include 'connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset ($admin_id)){
    header('location:admin_login.php');
}
?>
<style type="text/css">
    <?php  include 'backend.css'; 
    
    echo time();
    ?>
   
</style>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    
    <title>GREEN-TEA admin</title>
</head>
<body>
<?php  include 'admin_header.php'; ?>
    <div class="main">
        <div class ="banner">
            <h1>MESSAGE</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">home </a><span>/ Message</span>
        </div>
        <section class="dashboard">        
            <h1 class="heading" style="color: var(--green);">MESSAGE</h1>
            <div class="box-container">

               <div class="box">
                 <?php                 
                  $select_message = $conn->prepare("SELECT * FROM `message` WHERE status = ? ");
                  $select_message->execute(['initial']);
                  $num_of_message = $select_message->rowCount();
                 ?>
                 <h3><?=  $num_of_message; ?></h3>
                 <p>unread message</p>
                 <a href="message.php" class="btn">view message</a>
               </div>

               <div class="box">
                 <?php                 
                  $select_message = $conn->prepare("SELECT * FROM `message` WHERE status = ? ");
                  $select_message->execute(['complete']);
                  $num_of_message = $select_message->rowCount();
                 ?>
                 <h3><?=  $num_of_message; ?></h3>
                 <p>read complete message</p>
                 <a href="message_complete.php" class="btn">view message</a>
               </div>

            </div>
        </section>
    </div>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
 <!-- sweetalert js link -->
    <script src = "backend.js" ></script>
     <!-- alert -->
     <?php  include 'alert.php'; ?>
</body>

</html>
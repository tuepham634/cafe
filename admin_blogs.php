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
            <h1>Blogs</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">home </a><span>/ Blogs</span>
        </div>
        <section class="dashboard">        
            <h1 class="heading" style="color: var(--green);">BLOGS</h1>
            <div class="box-container">

               <div class="box">
                 <?php                 
                  $select_product = $conn->prepare("SELECT * FROM `blogs`");
                  $select_product->execute();
                  $num_of_products = $select_product->rowCount();
                 ?>
                 <h3><?= $num_of_products; ?></h3>
                 <p>blogs added</p>
                 <a href="add_blogs.php" class="btn"> add new blogs</a>
               </div>

               <div class="box">
                 <?php                 
                  $select_active_product = $conn->prepare("SELECT * FROM `blogs` WHERE status = ?");
                  $select_active_product->execute(['active']);
                  $num_of_active_products = $select_active_product->rowCount();
                 ?>
                 <h3><?= $num_of_active_products; ?></h3>
                 <p>total active blogs</p>
                 <a href="admin_view_blogs.php" class="btn"> view active blogs</a>
               </div>

               <div class="box">
                 <?php                 
                  $select_deactive_product = $conn->prepare("SELECT * FROM `blogs` WHERE status = ?");
                  $select_deactive_product->execute(['deactive']);
                  $num_of_deactive_products = $select_deactive_product->rowCount();
                 ?>
                 <h3><?= $num_of_deactive_products; ?></h3>
                 <p>total deactive blogs</p>
                 <a href="admin_view_unblogs.php" class="btn"> view deactive blogs</a>
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
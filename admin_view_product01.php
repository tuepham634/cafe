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
<link rel ="stylesheet" type = "text/css" href="backend.css?v=<?php echo time(); ?>">

    
    <title>GREEN-TEA view product</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class = "main">
        <div class = "banner">
            <h1>all products</h1>
        </div>
        <div class = "title2">
            <a href="dashboard.php">dashboard</a><span> / all products</span>
        </div>
        <section class = "show-post">
            <h1 class = "heading">all products</h1>
            <div class = "box-container">
                <?php
                    $select_products = $conn->prepare("select * from `products` where status = ? ");
                    $status_products = 'active';
                    $select_products->execute([$status_products]);
                    if($select_products->rowCount() > 0){
                        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

                ?>
                <form action="" method = "post" class = "box">
                    <input type="hidden" name="product_id" value="<?= $fetch_products['id'];?>">
                    <?php if($fetch_products['image'] != ''){?>
                        <!-- "../img/" -->
                        <img src="img/<?= $fetch_products['image']; ?>" alt="" class = "image">
                    <?php } ?>
                    <div class = "status" style="color: <?php if($fetch_products['status']=='active'){echo "green";}else{echo "red";} ?>;"><?= $fetch_products['status']; ?></div>
                    <div class="price"><?= number_format($fetch_products['price'], 0, ',', '.'); ?>đ</div>

                    <div class = "title"><?= $fetch_products['name']; ?></div>
                   
                </form>
                <?php
                        }
                    }else{
                        echo '<div class = "empty">
                                <p>no product added yet!</p>
                            </div>';
                    }
                ?>
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
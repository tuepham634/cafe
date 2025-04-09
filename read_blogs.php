<?php
include 'connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset ($admin_id)){
    header('location:admin_login.php');
}
    $get_id = $_GET['post_id'];
    
    if(isset($_POST['delete'])){
        $p_id = $_POST['product_id'];
        $p_id = filter_var($p_id,FILTER_SANITIZE_STRING);

        
            $delete_product = $conn->prepare("delete from `blogs` where id = ?");
            $delete_product->execute([$p_id]); 
            $success_msg[] = 'blogs deleted successfully';
    
        
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

    
    <title>GREEN COFFEE admin panel - read product page</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class = "main">
        <div class = "banner">
            <h1>Detail products</h1>
        </div>
        <div class = "title2">
            <a href="dashboard.php">dashboard</a><span> / Detail products</span>
        </div>
        <section class = "read-post">
            <h1 class = "heading">Detail Product</h1>
            <?php
                $select_product = $conn->prepare("select *from `blogs` where id = ?");
                $select_product->execute([$get_id]);

                if($select_product->rowCount() > 0){
                    while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
                     
            ?>
            <form action="" method = "post">
                    <input type="hidden" name="product_id" value="<?= $fetch_product['id'];?>">
                    <div class = "status" style="color: <?php if($fetch_product['status']=='active'){echo "green";}else{echo "red";} ?>;"><?= $fetch_product['status']; ?></div>
                    <?php if($fetch_product['image'] != ''){ ?>
                        <!-- "img/" -->
                        <img src="img/<?= $fetch_product['image']; ?>" alt="" class = "image-product">
                    <?php } ?>

                    <div class="price" style="font-size : 20px"><?= date("d-m-Y", strtotime($fetch_product['updated_at'])); ?></div>

                    <div class = "title"><?= $fetch_product['name']; ?></div>
                    <div class = "content"><?= $fetch_product['product_detail']; ?></div>
                    <div class="flex-btn">
                        <a href="edit_blogs.php?id=<?= $fetch_product['id']; ?>" class = "btn">edit</a>
                        <button type = "submit" name ="delete" class="btn" onclick="return confirm('delete this product');">delete</button>
                        <a href="admin_blogs.php" class = "btn">go back</a>
                    </div>
                    
                </form>
            <?php
                        }
                    }else{
                        echo '<div class = "empty">
                                <p>no product added yet! <br> <a href="add_products.php" style ="margin-top: 1.5rem;" class = "btn">add product</a></p>
                            </div>';
                    }
                ?>
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
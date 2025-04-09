
<?php
include 'connect.php';

session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
   $user_id='';
}
if(isset($_POST['logout'])){
    session_destroy();
    header("location:admin_login.php");
}

?>
<style type="text/css">
    <?php  include 'fontend.css'; ?>
   
</style>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>GREEN-TEA product detail</title>
</head>
<body>
    <?php  include 'header.php'; ?>

    <div class="main"> <!---HOME-->
       <div class="banner">
          <h1>Chi tiết bài viết</h1>
       </div>
        <div class="title2">
            <a href="home.php">home </a><span> / Chi tiết bài viết</span>
        </div>
        <section class = "view_page" id="blogs_page">
            <?php
                if(isset($_GET['pid'])) {
                    $pid = $_GET['pid'];
                    $select_products = $conn->prepare("select * from `blogs` where id = '$pid'");
                    $select_products->execute();
                    if($select_products->rowCount()>0){
                        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

            ?>
                 
                        <div id="box-blogs-detail">
                            <div id="img-blogs-detail">
                            <img src="img/<?php echo $fetch_products['image']; ?>" id="img">
                            </div>
                            <div id="content-blogs-detail">
                                <h3 id="title-blogs-detail"><?= $fetch_products['name']; ?></h3>
                                <div id="desc-blogs-detail">
                                <?= $fetch_products['product_detail']; ?>
                                </div>
                            </div>
                        </div>  
                   
            <?php
                        }
                    }
                }
            ?>
        </section>
        <?php include 'footer.php' ; ?>
     </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src = "fontend.js" ></script>
    <?php  include 'alert.php'; ?>

    
</body>

</html>
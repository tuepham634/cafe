<?php
include 'connect.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:admin_login.php");
}

?>
<style type="text/css">
    <?php include 'fontend.css'; ?>
</style>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="img/download.png" type="image/png">
    <title>Green Tea - Shop</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main"> <!---HOME-->
        <div class="banner">
            <h1>Shop</h1>
        </div>
        <div class="title2">
            <a href="home.php">home /</a><span> Bài Viết</span>
        </div>
        <section class="products">
            <div class="box-container">
                <?php
                $select_products = $conn->prepare("select * from `blogs` where status = 'active'");
                $select_products->execute();
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>

                    <a id="link-blogs" href="view_page_blogs.php?pid=<?php echo $fetch_products['id']; ?>">
                        <div id="box-blogs">
                            <div id="img-blogs">
                            <img src="img/<?php echo $fetch_products['image']; ?>" id="img">
                            </div>
                            <div id="content-blogs">
                                <h3 id="title-blogs"><?= $fetch_products['name']; ?></h3>
                                <div id="desc-blogs">
                                <?= $fetch_products['product_detail']; ?>
                                </div>
                            </div>
                        </div>  
                    </a>                        
                <?php
                    }
                } else {
                    echo '<p class = "empty">Chưa có bài viết nào</p>';
                }
                ?>
            </div>
        </section>
        <?php include 'footer.php'; ?>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   
    <?php include 'alert.php'; ?>

    <script src="fontend.js"></script>


</body>

</html>
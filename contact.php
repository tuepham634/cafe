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

if(isset($_POST['submit-btn'])){
    $id = unique_id();
  
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
 
    $email= $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $number= $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
 
    $message = $_POST['message'];
    $message = filter_var($message, FILTER_SANITIZE_STRING);
      
    if (empty($name) || empty($email) || empty($number) || empty($message)) {
        $error_msg[] = 'Tất cả các trường là bắt buộc liền!';
    } else {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $insert_message = $conn->prepare("INSERT INTO `message` (id, user_id, name, email, message, number, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insert_message->execute([$id, $user_id, $name, $email, $message, $number, 'initial']);
            $success_msg[] = 'Tin nhắn đã được gửi thành công!';
        } else {
            header("location:admin_login.php");
        }
    }



    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Green Tea - Contacts</title>
    <link rel="icon" href="img/download.png" type="image/png">
</head>

<body>
    <?php  include 'header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Liên hệ chúng tôi</h1>
        </div>
        <div class="title2">
            <a href="home.php">home</a><span> / Liên hệ</span>
        </div>
        <section class = "services">
        <div class="box-container">
            <div class="box">
               <img src="img/icon2.png">
               <div class="detail">
                <h3>great saving</h3>
                <p>save big every order</p>
               </div>
            </div>

            <div class="box">
               <img src="img/icon1.png">
               <div class="detail">
                <h3>24*7</h3>
                <p>one-on-one support</p>
               </div>
            </div>

            <div class="box">
                <img src="img/icon0.png">
                <div class="detail">
                <h3>gift vouchers</h3>
                <p>vochers on every festivals</p>
               </div>
            </div>

            <div class="box">
               <img src="img/icon.png">
               <div class="detail">
                <h3>Vận chuyển</h3>
                <p>Vận chuyển trong nội thành</p>
               </div>
            </div>
        </div>
    </section>
    <div class="form-container ">
        <form method="post" style=" text-align: center;">
            <div class = "title">
                <img src="img/download.png" class = "logo">
                <h1>GỬi tin nhắn</h1>
            </div>
            <div class ="input-field">
                <p>your name <sup>*</sup></p>
                <input type="text" name = "name" required>
            </div>
            <div class ="input-field">
                <p>your email <sup>*</sup></p>
                <input type="email" name = "email" required>
            </div>
            <div class ="input-field">
                <p>your number <sup>*</sup></p>
                <input type="text" name = "number" required>
            </div>
            <div class ="input-field">
                <p>your message <sup>*</sup></p>
                <textarea name="message" id="" required></textarea>
            </div>
            <button type="submit" name = "submit-btn" class="btn">send message</button>
        </form>
    </div>
    <div class= " address">
        <div class = "title">
            <img src="img/download.png" class = "logo">
            <h1>Chi tiết liên hệ</h1>
        </div>
        <div class = "box-container">
            <div class = "box">
                <i class = "bx bxs-map-pin"></i>
                <div>
                    <h4>Địa chỉ</h4>
                    <p>Trường Đại Học Công Nghệ GTVT</p>
                </div>
            </div>
            <div class = "box">
                <i class="fa-regular fa-message"></i>
                <div>
                    <h4>Zalo</h4>
                    <p>091836847</p>
                </div>
            </div>
            <div class = "box">
                <i class = "bx bxs-map-pin"></i>
                <div>
                    <h4>email</h4>
                    <p>nguyenvana@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
        <?php include 'footer.php' ; ?>
     </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src = "fontend.js" ></script>
    <?php  include 'alert.php'; ?>
</body>
</html>
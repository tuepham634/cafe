<?php
include 'connect.php';
session_start();



if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra xem email có tồn tại không
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);

    if ($select_user->rowCount() == 0) {
        $warning_msg[] = 'Email does not exist.';
    } else {
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra mật khẩu cũ
        if ($current_password != $row['password']) {
            $warning_msg[] = ' Current password is incorrect..';   
        } else {
            // Kiểm tra mật khẩu mới và xác nhận mật khẩu
            if ($new_password != $confirm_password) {
                $warning_msg[] = 'password is not confirm';
            } else {
                // Cập nhật mật khẩu mới
                $update_password = $conn->prepare("UPDATE `users` SET password = ? WHERE email = ?");
                $update_password->execute([$new_password, $email]);

                $success_msg[] = 'updated success';
               
            }
        }
    }
}
?>

<style type="text/css">
    <?php  include 'fontend.css'; 
      
      echo time();
    ?>
   
</style>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<title>Change Password</title>
</head>
<body>
    <div class="form-container">
        <section class="form-container">
            <div class="title">
                <h1>Change Password</h1>
            </div>
            <form method="post" action="">
                <div class="input-field">
                    <p>Your Email <sup>*</sup></p>
                    <input type="email" name="email" required placeholder="Enter your email" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">                    
                </div>

                <div class="input-field">
                    <p>Current Password <sup>*</sup></p>
                    <input type="password" name="current_password" required placeholder="Enter your current password" maxlength="50">                    
                </div>

                <div class="input-field">
                    <p>New Password <sup>*</sup></p>
                    <input type="password" name="new_password" required placeholder="Enter your new password" maxlength="50">                    
                </div>

                <div class="input-field">
                    <p>Confirm New Password <sup>*</sup></p>
                    <input type="password" name="confirm_password" required placeholder="Confirm your new password" maxlength="50">                    
                </div>

                <input type="submit" name="submit" value="Change Password" class="btn" style="background-color: var(--light-green);">
                <p><a href="admin_login.php">login now</a></p>
                
            </form>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
    <?php  include 'alert.php'; ?>
</body>
</html>

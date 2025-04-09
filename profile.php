<?php
include 'connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['update_password'])) {
    $new_password = $_POST['new_password'];
    $new_password = filter_var($new_password, FILTER_SANITIZE_STRING);

    $confirm_password = $_POST['confirm_password'];
    $confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);

    if ($new_password != $confirm_password) {
        $warning_msg[] = 'Password confirmation does not match.';
    } else {
        // Directly update the password (no hashing)
        $update_password = $conn->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
        $update_password->execute([$new_password, $admin_id]);
        
        $success_msg[] = 'Password updated successfully.';
        header('location:admin_login.php');
    }
}
?>
<style type="text/css">
    <?php include 'backend.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="backend.css">
    <title>GREEN-TEA Admin Profile</title>
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Profile</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">Dashboard</a><span> / Profile</span>
        </div>
        <section class="order-container">
            <h1 class="heading">Profile</h1>
            <div class="box-container">

                <?php
                $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
                $select_admin->execute([$admin_id]);
                if ($select_admin->rowCount() > 0) {
                    $fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);
                ?>

                        <div class="inner-wrap">
                            <div class="image">
                                <img src="img/<?= trim($fetch_admin['profile']); ?>" class="img">
                            </div>

                            <div class="content">
                                <label for="">Fullname</label>
                                <div class="label name">
                                    <?= htmlspecialchars($fetch_admin['name']); ?>
                                </div>

                                <label for="">Gmail</label>
                                <div class="label gmail">
                                    <?= htmlspecialchars($fetch_admin['email']); ?>
                                </div>

                                <form method="POST" action="">

                                    <label for="">New Password</label>
                                    <input style="display: block;" class="label" type="password" name="new_password" required placeholder="Enter new password">

                                    <label for="">Confirm New Password</label>
                                    <input type="password" style="display: block;" class="label" name="confirm_password" required placeholder="Confirm new password">

                                    <button type="submit" name="update_password" class="btn">Update Password</button>
                                </form>
                            </div>
                        </div>
                <?php
                } else {
                    echo '<p class="empty">No account found</p>';
                }
                ?>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="backend.js"></script>
    <?php include 'alert.php'; ?>
</body>

</html>

<?php
include 'connect.php';
session_start();

// Kiểm tra xem admin đã đăng nhập chưa
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// Xóa đơn hàng
if (isset($_POST['delete_order'])) {
    $order_id = filter_var($_POST['order_id'], FILTER_SANITIZE_STRING);
    $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
    $verify_delete->execute([$order_id]);
    if ($verify_delete->rowCount() > 0) {
        $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
        $delete_order->execute([$order_id]);
        $success_msg[] = 'Đã xóa đơn hàng';
    } else {
        $warning_msg[] = 'Đơn hàng đã được xóa';
    }
}

// Cập nhật đơn hàng
if (isset($_POST['update_order'])) {
    $order_id = filter_var($_POST['order_id'], FILTER_SANITIZE_STRING);
    $update_payment = filter_var($_POST['update_payment'], FILTER_SANITIZE_STRING);

    // Cập nhật trạng thái tùy theo tình trạng thanh toán
    if ($update_payment == 'complete') {
        $update_status = "delivered";
        $update_bom = $conn->prepare("UPDATE `users` SET bom = bom - 1 WHERE id = (SELECT user_id FROM `orders` WHERE id = ?) AND bom > 0");
        $update_bom->execute([$order_id]);
    } elseif ($update_payment == 'uncomplete') {
        $update_status = 'canceled-nv';
        $update_bom = $conn->prepare("UPDATE `users` SET bom = bom + 1 WHERE id = (SELECT user_id FROM `orders` WHERE id = ?)");
        $update_bom->execute([$order_id]);
    } else {
        $update_status = 'in progress';
    }

    $update_pay = $conn->prepare("UPDATE `orders` SET status = ?, payment_status = ? WHERE id = ?");
    $update_pay->execute([$update_status, $update_payment, $order_id]);

    $success_msg[] = 'Đã cập nhật đơn hàng';
}

?>

<style type="text/css">
    <?php include 'backend.css';
    echo time(); ?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="backend.css?v=<?php echo time(); ?>">
    <title>GREEN-TEA order in initial</title>
</head>

<body>
    <?php include 'admin_header.php'; ?>

    <div class="main">
        <div class="banner">
            <h1>order placed</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">dashboard</a><span> / order placed</span>
        </div>
        <section class="order-container">
            <h1 class="heading">total order placed</h1>
            <div class="box-container">
                <?php
                $select_orders = $conn->prepare("
                SELECT orders.*, users.bom 
                FROM `orders` 
                JOIN `users` ON orders.user_id = users.id
                WHERE status = 'in progress'
                 ORDER BY orders.date DESC
            ");
                $select_orders->execute();
                if ($select_orders->rowCount() > 0) {
                    while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                        $bomhang = $fetch_orders['bom'];
                        $id = $fetch_orders['user_id'];
                        $color = ($bomhang > 0) ? 'red' : 'inherit';
                ?>
                        <div class="box">
                            <div class="status" style="color: 
                    <?php
                        if ($fetch_orders['status'] == 'delivered') {
                            echo "green";
                        } elseif ($fetch_orders['status'] == 'in progress') {
                            echo "blue";
                        } elseif ($fetch_orders['status'] == 'canceled-nv') {
                            echo "red";
                        } elseif ($fetch_orders['status'] == 'canceled-kh') {
                            echo "brown";
                        } else {
                            echo 'orange';
                        } ?>">
                                <?= $fetch_orders['status']; ?>
                            </div>
                            <div class="detail">
                                <p>user name: <span><?= $fetch_orders['name']; ?></span></p>
                                <p>user id: <span style="color: <?= $color; ?>;"><?= $id; ?></span></p>
                                <p>placed on: <span><?= $fetch_orders['date']; ?></span></p>
                                <p>user number: <span><?= $fetch_orders['number']; ?></span></p>
                                <p>user email: <span><?= $fetch_orders['email']; ?></span></p>
                                <p>total price: <span><?= $fetch_orders['price']; ?></span></p>
                                <p>method: <span><?= $fetch_orders['method']; ?></span></p>
                                <p>address: <span><?= $fetch_orders['address']; ?></span></p>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                                <select name="update_payment" id="">
                                    <option selected><?= $fetch_orders['payment_status']; ?></option>
                                    <option value="pending">Pending</option>
                                    <option value="complete">Complete</option>
                                    <option value="uncomplete">uncomplete</option>
                                </select>
                                <div class="flex-btn">
                                    <button type="submit" name="update_order" class="btn">Update Payment</button>
                                    <button type="submit" name="delete_order" class="btn">Delete Payment</button>
                                </div>
                            </form>
                            <form action="print_invoice.php" method="post" target="_blank">
                                <input type="hidden" name="date" value="<?= $fetch_orders['date']; ?>">
                                <input type="hidden" name="user_id" value="<?= $fetch_orders['user_id']; ?>">
                                <button type="submit" class="btn">Print Bill</button>
                            </form>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="empty"><p>Không có đơn hàng nào được đặt.</p></div>';
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
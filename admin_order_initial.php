<?php
include 'connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:admin_login.php');
}
//delete order
if (isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'];
    $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);
    $verify_delete = $conn->prepare("select * from `orders` where id = ?  ");
    $verify_delete->execute([$order_id]);
    if ($verify_delete->rowCount() > 0) {
        $delete_order = $conn->prepare("delete from `orders` where id = ?");
        $delete_order->execute([$order_id]);
        $success_msg[] = 'order deleted';
    } else {
        $warning_msg[] = 'order already deleted';
    }
}

//update order
if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);
    $update_payment = $_POST['update_payment'];
    $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);

    // xet truong hop cho status 
    if ($update_payment == 'complete') {
        $update_status = "delivered";
        $update_bom = $conn->prepare("
        UPDATE `users` 
        SET bom = bom - 1 
        WHERE id = (SELECT user_id FROM `orders` WHERE id = ?) 
        AND bom > 0
        ");
        $update_bom->execute([$order_id]);
    } else if ($update_payment == 'uncomplete') {
        $update_status = 'canceled-nv';
        $update_bom = $conn->prepare("UPDATE `users` SET bom = bom + 1 WHERE id = (SELECT user_id FROM `orders` WHERE id = ?)");
        $update_bom->execute([$order_id]);
    } else {
        $update_status = 'in progress';
    }

    $update_status = filter_var($update_status, FILTER_SANITIZE_STRING);

    $update_pay = $conn->prepare("update `orders` set status = ?, payment_status = ? where id = ?");
    $update_pay->execute([$update_status, $update_payment, $order_id]);

    $success_msg[] = 'order updated';
}
?>
<style type="text/css">
    <?php include 'backend.css';

    echo time();
    ?>
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
                    where status = 'initial'
                ");
                $select_orders->execute();
                if ($select_orders->rowCount() > 0) {
                    while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                        $bomhang = $fetch_orders['bom']; // Lấy giá trị cột bomhang từ bảng user
                        $id = $fetch_orders['user_id']; // Lấy giá trị user_id
                        $color = ($bomhang > 0) ? 'red' : 'inherit'; // Kiểm tra điều kiện và chọn màu
                ?>
                        <div class="box">
                            <div class="status" style="color: 
                        <?php
                        if ($fetch_orders['status'] == 'delivered') {
                            echo "green";
                        } else if ($fetch_orders['status'] == 'in progress') {
                            echo "blue";
                        } else if ($fetch_orders['status'] == 'canceled-nv') {
                            echo "red";
                        } else if ($fetch_orders['status'] == 'canceled-kh') {
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

                                </select>
                                <div class="flex-btn">
                                    <button type="submit" name="update_order" class="btn">Update Payment</button>
                                    <button type="submit" name="delete_order" class="btn">Delete Payment</button>
                                </div>
                            </form>
                        </div>
                <?php
                    }
                } else {
                    echo '
                            <div class = "empty">
                                <p>no order take placed yet</p>
                            </div>
                        ';
                }
                ?>
            </div>
        </section>
    </div>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- sweetalert js link -->
    <script src="backend.js"></script>
    <!-- alert -->
    <?php include 'alert.php'; ?>
</body>

</html>
<?php
include 'connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
  header('location:admin_login.php');
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


  <title>GREEN-TEA admin</title>
</head>

<body>
  <?php include 'admin_header.php'; ?>
  <div class="main">
    <div class="banner">
      <h1>Dashboard</h1>
    </div>
    <div class="title2">
      <a href="dashboard.php">home </a><span>/ dashboard</span>
    </div>
    <section class="dashboard">
      <h1 class="heading">dashboard</h1>
      <div class="box-container">
        <div class="box">
          <h3>Welcome !</h3>
          <p><?= $fetch_profile['name']; ?></p>
          <a href="#" class="btn" onclick="verifyPassword()">Check Profile</a>
        </div>
        <div class="box">
          <h3>Revenue</h3>
          <p>green tea</p>
          <a href="admin_checkRevenue.php" class="btn">Check Revenue</a>
        </div>
        <div class="box">
          <h3>Products</h3>
          <p>Sản phẩm</p>
          <a href="#" class="btn" onclick="verifyPassword()">Check products</a>
        </div>
        <div class="box">
          <h3>Blogs</h3>
          <p>Bài viết</p>
          <a href="#" class="btn" onclick="verifyPassword()">Check blogs</a>
        </div>
        
        <div class="box">
          <h3>Message</h3>
          <p>Tin nhắn</p>
          <a href="admin_message.php" class="btn">view message</a>
        </div>
        <div class="box">
          <?php
          $select_orders = $conn->prepare("SELECT * FROM `orders`");
          $select_orders->execute();
          $num_of_orders = $select_orders->rowCount();
          ?>
          <h3><?= $num_of_orders; ?></h3>
          <p>total orders palced</p>
          <a href="admin_order.php" class="btn">view orders</a>
        </div>

        <div class="box">
          <?php
          $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
          $select_confirm_orders->execute(['initial']);
          $num_of_confirm_orders = $select_confirm_orders->rowCount();
          ?>
          <h3><?= $num_of_confirm_orders; ?></h3>
          <p>total Initial orders </p>
          <a href="admin_order_initial.php" class="btn">view initial orders</a>
        </div>

        <div class="box">
          <?php
          $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
          $select_confirm_orders->execute(['in progress']);
          $num_of_confirm_orders = $select_confirm_orders->rowCount();
          ?>
          <h3><?= $num_of_confirm_orders; ?></h3>
          <p>total Inprogress orders </p>
          <a href="admin_order_inprogress.php" class="btn">view inprogress orders</a>
        </div>
        <div class="box">
          <?php
          $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
          $select_confirm_orders->execute(['delivered']);
          $num_of_confirm_orders = $select_confirm_orders->rowCount();
          ?>
          <h3><?= $num_of_confirm_orders; ?></h3>
          <p>total confirm orders </p>
          <a href="admin_order_confirm.php" class="btn">view confirm orders</a>
        </div>

        <div class="box">
          <?php
          $select_canceled_orders = $conn->prepare("SELECT * FROM `orders` WHERE status IN (?, ?)");
          $select_canceled_orders->execute(['canceled-kh', 'canceled-nv']);
          $num_of_canceled_orders = $select_canceled_orders->rowCount();
          ?>
          <h3><?= $num_of_canceled_orders; ?></h3>
          <p>total canceled orders </p>
          <a href="admin_order_canceled.php" class="btn">view confirm orders</a>
        </div>
        <!-- Form nhập mật khẩu tạm thời -->
        <div id="password-modal" style="display:none;">
          <div class="divaa">
            <div class="modal-content">
              <label for="password">Enter Password:</label>
              <input type="password" id="password" name="password" required>
              <button onclick="checkPassword()">Submit</button>
              <button onclick="cancelPassword()">Cancel</button>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>

  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <!-- sweetalert js link -->
  <script src="backend.js"></script>

  <script>
    function verifyPassword() {
      // Hiển thị form nhập mật khẩu
      document.getElementById('password-modal').style.display = 'block';
    }

    function checkPassword() {
      // Lấy giá trị mật khẩu
      const password = document.getElementById('password').value;

      // Kiểm tra mật khẩu
      if (password === "1") { // Thay "admin123" bằng mật khẩu bạn muốn
        window.location.href = "admin_product.php"; // Chuyển hướng nếu mật khẩu đúng
      } else if (password === "2") {
        window.location.href = "admin_blogs.php";
       
      } else if (password === "0") {
        window.location.href = "profile.php";
      } else {
        alert("Incorrect password. Access denied!"); // Hiển thị cảnh báo nếu mật khẩu sai
      }
    }

    function cancelPassword() {
      // Ẩn form nhập mật khẩu nếu nhấn hủy
      document.getElementById('password-modal').style.display = 'none';
    }
  </script>

  <!-- alert -->
  <?php include 'alert.php'; ?>
</body>

</html>
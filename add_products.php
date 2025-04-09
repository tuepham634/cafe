<?php
include 'connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// Add product in database (Publish product)
if (isset($_POST['publish'])) {
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    $status = 'active'; // Product status (active for publish)

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = 'C:\xampp\htdocs\img';
    $image_folder = '../image/' . $image;

    $confirm_password = $_POST['confirm_password'];
    $confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);

    // Kiểm tra mật khẩu (chỉ cần bằng 1)
    if ($confirm_password != '1') {
        $warning_msg[] = 'Password is incorrect!';
    } else {
        // Kiểm tra tên ảnh có bị trùng hay không
        $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ?");
        $select_image->execute([$image]);

        if (isset($image)) {
            if ($select_image->rowCount() > 0) {
                $warning_msg[] = 'Image name repeated';
            } elseif ($image_size > 2000000) {
                $warning_msg[] = 'Image is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
            }
        } else {
            $image = '';
        }

        if ($select_image->rowCount() > 0 && $image != '') {
            $warning_msg[] = 'Please rename your image';
        } else {
            // Insert product vào cơ sở dữ liệu
            $insert_product = $conn->prepare("INSERT INTO `products` (id, name, price, image, product_detail, status) VALUES(?, ?, ?, ?, ?, ?)");
            $insert_product->execute([$id, $name, $price, $image, $content, $status]);
            $success_msg[] = 'Product published successfully';
        }
    }
}

// Save product as draft
if (isset($_POST['draft'])) {
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    $status = 'deactive'; // Product status (deactive for draft)

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = 'C:\xampp\htdocs\img';
    $image_folder = '../image/' . $image;

    $confirm_password = $_POST['confirm_password'];
    $confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);

    // Kiểm tra mật khẩu (chỉ cần bằng 1)
    if ($confirm_password != '1') {
        $warning_msg[] = 'Password is incorrect!';
    } else {
        // Kiểm tra tên ảnh có bị trùng hay không
        $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ?");
        $select_image->execute([$image]);

        if (isset($image)) {
            if ($select_image->rowCount() > 0) {
                $warning_msg[] = 'Image name repeated';
            } elseif ($image_size > 2000000) {
                $warning_msg[] = 'Image is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
            }
        } else {
            $image = '';
        }

        if ($select_image->rowCount() > 0 && $image != '') {
            $warning_msg[] = 'Please rename your image';
        } else {
            // Insert product vào cơ sở dữ liệu
            $insert_product = $conn->prepare("INSERT INTO `products` (id, name, price, image, product_detail, status) VALUES(?, ?, ?, ?, ?, ?)");
            $insert_product->execute([$id, $name, $price, $image, $content, $status]);
            $success_msg[] = 'Product saved as draft successfully';
        }
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
    <title>GREEN-TEA Add Product Admin</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="main">
        <div class="banner">
            <h1>Add Products</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">Dashboard</a><span>Add Product</span>
        </div>
        <section class="form-container">
            <h1 class="heading">Add Products</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="input-field">
                    <label>Product Name <sup>*</sup></label>
                    <input type="text" name="name" required placeholder="Add product name" maxlength="100">
                </div>

                <div class="input-field">
                    <label>Product Price <sup>*</sup></label>
                    <input type="number" name="price" required placeholder="Add product price" min=0  maxlength="100">
                </div>

                <div class="input-field">
                    <label>Product Detail <sup>*</sup></label>
                    <textarea name="content" required maxlength="10000" placeholder="Write product description"></textarea>
                </div>

                <div class="input-field">
                    <label>Product Image <sup>*</sup></label>
                    <input type="file" name="image" accept="image/*" required>
                </div>

                <div class="input-field">
                    <label class="">Enter Your Password <sup>*</sup></label>
                    <input type="password" name="confirm_password" required placeholder="Enter your password" maxlength="100" style="padding: 20px; border-radius: 20px ">
                </div>

                <div class="flex-btn">
                    <button type="submit" name="publish" class="btn">Publish Product</button>
                    <button type="submit" name="draft" class="btn">Save as Draft</button>
                </div>
            </form>
        </section>
    </div>

    <!-- SweetAlert CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Custom JS -->
    <script src="backend.js"></script>
    <!-- Alert -->
    <?php include 'alert.php'; ?>
</body>
</html>

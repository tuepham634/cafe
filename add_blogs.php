<?php
include 'connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// add product in database
if (isset($_POST['publish'])) {
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    $status = 'active';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = 'C:\xampp\htdocs\img';
    $image_folder = '../image/' . $image;

    // Skip password verification and set password check as 2
    $confirm_password = $_POST['confirm_password'];
    if ($confirm_password != '1') {
        $warning_msg[] = 'Password is incorrect!';
    } else {
        // Check if image name is repeated
        $select_image = $conn->prepare("SELECT * FROM `blogs` WHERE image = ?");
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
            // Insert product into database
            $insert_product = $conn->prepare("INSERT INTO `blogs` (id, name, image, product_detail, status) VALUES(?, ?, ?, ?, ?)");
            $insert_product->execute([$id, $name, $image, $content, $status]);
            $success_msg[] = 'Blog inserted successfully';
        }
    }
}

// save product in database as draft
if (isset($_POST['draft'])) {
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    $status = 'deactive';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = 'C:\xampp\htdocs\img';
    $image_folder = '../image/' . $image;

    // Skip password verification and set password check as 2
    $confirm_password = $_POST['confirm_password'];
    if ($confirm_password != '1') {
        $warning_msg[] = 'Password is incorrect!';
    } else {
        // Check if image name is repeated
        $select_image = $conn->prepare("SELECT * FROM `blogs` WHERE image = ?");
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
            // Insert product into database as draft
            $insert_product = $conn->prepare("INSERT INTO `blogs` (id, name, image, product_detail, status) VALUES(?, ?, ?, ?, ?)");
            $insert_product->execute([$id, $name, $image, $content, $status]);
            $success_msg[] = 'Blog saved as draft successfully';
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
    <title>GREEN-TEA add product admin</title>
</head>
<body>
<?php include 'admin_header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Add Blogs</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">Dashboard</a><span>Add Blogs</span>
        </div>
        <section class="form-container">
            <h1 class="heading">Add Blogs</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="input-field">
                    <label>Blog Name <sup>*</sup></label>
                    <input type="text" name="name" required placeholder="Add blog name" maxlength="100">
                </div>

                <div class="input-field">
                    <label>Blog Description <sup>*</sup></label>
                    <textarea name="content" required maxlength="10000" placeholder="Write blog description"></textarea>
                </div>

                <div class="input-field">
                    <label>Blog Image <sup>*</sup></label>
                    <input type="file" name="image" accept="image/*" required>
                </div>

                <div class="input-field">
                    <label>Enter Your Password <sup>*</sup></label>
                    <input type="password" name="confirm_password" required placeholder="Enter your password" maxlength="100" style="padding: 20px; border-radius: 20px ">
                </div>

                <div class="flex-btn">
                    <button type="submit" name="publish" class="btn">Publish Blog</button>
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

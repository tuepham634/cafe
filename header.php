<header class="header">
    <div class="flex">
        <a href="home.php" class="logo"><img src="img/logo.jpg"></a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="view_products.php">products</a>
            <a href="view_blogs.php">blogs</a>
            <a href="order.php">orders</a>
            <a href="about.php">about us</a>
            <a href="contact.php">contact us</a>
        </nav>

          <!-- Khu vực tìm kiếm -->
          <div class="search-container">
            <input type="text" id="search" placeholder="Tìm kiếm sản phẩm..." onkeyup="searchProducts()" />
            <button type="submit" class="search-btn" onclick="event.preventDefault();">
                <i class="bx bx-search"></i>
            </button>
        </div>

        <!-- Khu vực hiển thị sản phẩm tìm kiếm -->
        <div id="search-results" class="search-results" style="display: none;"></div>



        <div class="icons">
            <i class="bx bxs-user" id="user-btn"></i>
            <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_items = $count_wishlist_items->rowCount();
            ?>
            <a href="wishlist.php" class="cart-btn" style="margin-right: .3rem;">
                <i class="bx bx-heart"></i><sup style="position: absolute;"><?= $total_wishlist_items ?></sup>
            </a>
            <?php
           
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
            ?>
            <a href="cart.php" class="cart-btn" style="margin-right: 1.5rem;">
                <i class="bx bx-cart-download"></i><sup style="position: absolute;"><?= $total_cart_items ?></sup>
            </a>
            <i class="bx bx-list-plus" id="menu-btn" style="font-size: 2rem;"></i>
        </div>

        

        <!-- Thanh thông tin người dùng -->
        <div class="user-box">
            <p>username: <span><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?></span></p>
            <p>email: <span><?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?></span></p>
            <a href="admin_login.php" class="btn" style="color: #000">login</a>
            <a href="register.php" class="btn" style="color: #000">register</a>
            <form method="post">
                <button type="submit" name="logout" class="logout-btn">log out</button>
            </form>
        </div>
    </div>
</header>

<script>
//  search sản phẩm 
function searchProducts() {
    var query = document.getElementById('search').value;  // Lấy giá trị từ ô tìm kiếm
    var resultsContainer = document.getElementById('search-results');  // Khu vực hiển thị kết quả tìm kiếm

    if (query.length > 0) {
        // Gửi yêu cầu AJAX tới search_products.php
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'search_products.php?q=' + encodeURIComponent(query), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var products = JSON.parse(xhr.responseText);  // Chuyển đổi JSON trả về thành mảng
                if (products.length > 0) {
                    console.log("Có sản phẩm");
                    var html = '';
                    products.forEach(function(product) {
                        // Tạo HTML cho mỗi sản phẩm tìm thấy
                        html += '<div class="product-item">';
                        html += '<a href="view_page.php?pid=' + product.id + '" id="product-link">';
                        html += '<img src="img/' + product.image + '" alt="' + product.name + '" id="product-image" />';  // Hiển thị ảnh
                        html += '<div class="product-name">' + product.name + '</div>';
                        html += '</a>';
                        html += '</div>';
                    });
                    resultsContainer.innerHTML = html;  // Hiển thị kết quả trong container
                    resultsContainer.style.display = 'block';
                } else {
                    resultsContainer.innerHTML = 'Không có sản phẩm nào tìm thấy.';  // Thông báo khi không có kết quả
                    resultsContainer.style.display = 'block';
                }
            }
        };
        xhr.send();
    } else {
        resultsContainer.style.display = 'none';  // Ẩn kết quả nếu không có gì gõ
    }
}

</script>




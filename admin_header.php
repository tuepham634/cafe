

<header class="header" >
    <div class="flex">
        <a href="dashboard.php" class = "logo" ><img src ="img/logo.jpg"></a>
        <nav class = "navbar">
              <a href = "dashboard.php">dashboard</a>
              <a href ="add_products.php">add products</a>
              <a href ="add_blogs.php">add blogs</a>
              <a href ="admin_view_product01.php">view products</a>
              <a href ="admin_view_blogs01.php">view blogs</a>
              <a href = "account.php">accounts</a>
              
        </nav>
        
        <div class="icons">
           <i class="bx bxs-user" id="user-btn"></i>
           <i class="bx bx-list-plus" id="menu-btn" style="font-size: 2rem;"></i>
        </div>
    <div class="profile-detail">
            <?php
                $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
                $select_profile->execute([$admin_id]);
                if($select_profile->rowCount()>0){
                   $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                   
                } 
            ?>
        <div class="profile">
            <img src="img/<?= trim($fetch_profile['profile']); ?>" class="img">
            <p><?= $fetch_profile['name']; ?></p>
        </div>
        <div class="flex-btn">
            
            <a href = "admin_logout.php" onclick="return confirm('logout from this website');" class="btn">logout</a>
        </div>
    </div>

    
</header>
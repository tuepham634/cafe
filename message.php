<?php
include 'connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset ($admin_id)){
    header('location:admin_login.php');
}



// update message
if(isset($_POST['read_message'])){
   
    $read_message_id = $_POST['read_message_id'];
    $read_message_id  = filter_var($read_message_id , FILTER_SANITIZE_STRING);

    $update_status = "complete";

    $update_status = filter_var($update_status, FILTER_SANITIZE_STRING);
   
    $read_message  = $conn->prepare("update  `message` set status = ? where id = ?");
    $read_message ->execute([$update_status ,$read_message_id ]);

    $success_msg[] = 'message complete';
    header('location:dashboard.php');
}
?>
<style type="text/css">
    <?php  include 'backend.css'; 
    
    echo time();
    ?>
   
</style>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel ="stylesheet" type = "text/css" href="backend.css?v=<?php echo time(); ?>">

    
    <title>GREEN-TEA message admin</title>
</head>
<body>
<?php  include 'admin_header.php'; ?>
    <div class="main">
        <div class = "banner">
            <h1>unread message's</h1>
        </div>
        <div class = "title2">
            <a href="dashboard.php">dashboard</a><span> /unread message's</span>
        </div>
        <section class = "accounts">
            <h1 class="heading">unread message's</h1>
            <div class = "box-container ">
                <?php
                    $select_message = $conn->prepare("select * from `message` where status = 'initial'");
                    $select_message->execute();
                    if($select_message->rowCount() > 0 ){
                        while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
                            

                ?>
                <div class = "box">
                    <h3 class ="name"><?= $fetch_message['name'];?></h3>
                    <h4 class="email"><?= $fetch_message['email'];?></h4>                  
                    <h4 class="number"><?= $fetch_message['number'];?></h4>                  
                    <p><?=$fetch_message['message']; ?></p>
                    
                    <form action="" method="post" class="flex-btn">
                        <input type="hidden" 
                        name="read_message_id" 
                        value="<?= $fetch_message['id'];?>">

                        <button type="submit" 
                        name="read_message" 
                        class="btn" 
                        onclick="return confirm('Mark this message as complete?');">complete message</button>

                    </form>
                </div>
                <?php
                        }
                    }else{
                        echo '
                            <div class = "empty">
                                <p>no message send yet</p>
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
    <script src = "backend.js" ></script>
     <!-- alert -->
     <?php  include 'alert.php'; ?>
</body>

</html>
<?php
include 'connect.php';

// Kiểm tra xem có nhận được order_id và user_id không
if (isset($_POST['date']) && isset($_POST['user_id'])) {
    $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_STRING);

    // Truy vấn để lấy thông tin chi tiết đơn hàng và người dùng, bao gồm cả số lượng
    $query = $conn->prepare("
            SELECT 
            o.user_id,
            MAX(o.name) AS user_name,
            MAX(o.number) AS number,
            MAX(o.address) AS address,
            o.date,
            GROUP_CONCAT(p.name ORDER BY p.name ASC) AS products,  
            GROUP_CONCAT(o.qty ORDER BY p.name ASC) AS quantities, 
            SUM(o.price * o.qty) AS total_price
        FROM 
            orders o
        JOIN 
            products p ON o.product_id = p.id
        WHERE 
            o.user_id = ? And o.date = ?
        GROUP BY 
            o.user_id, o.date

    ");
    $query->execute([$user_id, $date]);

    // Kiểm tra xem có kết quả trả về không
    if ($query->rowCount() > 0) {
        $invoice = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "<p>Không tìm thấy hóa đơn.</p>";
        exit();
    }
} else {
    echo "<p>Dữ liệu không hợp lệ.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Hóa Đơn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url('img/body-bg.jpg');
        }

        .invoice {
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            background-color: white;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .invoice h1 {
            text-align: center;
            color: var(--light-green);
            margin-bottom: 20px;
        }

        .invoice p {
            margin: 15px 0;
            font-size: 16px;
        }

        .invoice .products {
            margin-top: 10px;
            text-align: left;
            font-size: 14px;
        }

        .invoice .total-price {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .invoice .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 30px;
        }

        .print-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #2675CA;

            color: white;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="invoice">
        <h1>Hóa Đơn Cafe Green</h1>
        <p><strong>Tên Khách Hàng:</strong> <?= htmlspecialchars($invoice['user_name']); ?></p>
        <p><strong>Số Điện Thoại:</strong> <?= htmlspecialchars($invoice['number']); ?></p>
        <p><strong>Địa Chỉ:</strong> <?= htmlspecialchars($invoice['address']); ?></p>
        <p><strong>Ngày Đặt:</strong> <?= htmlspecialchars($invoice['date']); ?></p>

        <div class="products">
            <p><strong>Sản Phẩm:</strong></p>
            <ul>
                <?php
                $products = explode(",", $invoice['products']);
                $quantities = explode(",", $invoice['quantities']);
                foreach ($products as $index => $product) {
                    echo "<li>" . htmlspecialchars($product) . " - Số lượng: " . htmlspecialchars($quantities[$index]) . "</li>";
                }
                ?>
            </ul>
        </div>

        <p class="total-price"><strong>Tổng Giá:</strong> <?= number_format($invoice['total_price'],  0, '.', '.'); ?> VND</p>

        <div class="footer">
            <p>Cảm ơn bạn đã mua sắm tại Cafe Green!</p>
        </div>
        <button class="print-btn no-print" onclick="window.print()">Print</button>

    </div>



</body>

</html>
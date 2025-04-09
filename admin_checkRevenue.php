<?php
include 'connect.php';
session_start();

// Kiểm tra phiên admin
$admin_id = $_SESSION['admin_id'] ?? null;
if (!$admin_id) {
    header('location:admin_login.php');
    exit;
}

// Xử lý ngày được chọn
$selected_date = $_POST['date'] ?? date('Y-m-d');
$selected_start_date = $_POST['start_date'] ?? date('Y-m-d');
$selected_end_date = $_POST['end_date'] ?? date('Y-m-d', strtotime('+1 week', strtotime($selected_start_date)));

// Xử lý lựa chọn khoảng thời gian
$period_option = $_POST['period_option'] ?? 'week';
$selected_year = $_POST['year'] ?? date('Y');
$start_year = $_POST['start_year'] ?? date('Y');
$end_year = $_POST['end_year'] ?? date('Y');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="backend.css?v=<?php echo time(); ?>">
    <title>GREEN-TEA Revenue</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function updateEndDate() {
            const startDate = document.getElementById('start_date').value;
            const endDate = new Date(startDate);
            endDate.setDate(endDate.getDate() + 7);
            document.getElementById('end_date').value = endDate.toISOString().split('T')[0];
        }

        function toggleDateSelection() {
            const period = document.getElementById('period_option').value;
            const weekSelection = document.getElementById('week_selection');
            const monthSelection = document.getElementById('month_selection');
            const yearSelection = document.getElementById('year_selection');

            // Ẩn tất cả các phần trước
            weekSelection.style.display = 'none';
            monthSelection.style.display = 'none';
            yearSelection.style.display = 'none';

            // Hiển thị phần tương ứng với khoảng thời gian đã chọn
            if (period === 'week') {
                weekSelection.style.display = 'inline';
            } else if (period === 'month') {
                monthSelection.style.display = 'inline';
            } else if (period === 'year') {
                yearSelection.style.display = 'inline';
            }
        }

        window.onload = toggleDateSelection; // Gọi khi trang được tải để điều chỉnh theo khoảng thời gian đã chọn
    </script>
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Revenue</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">Dashboard</a><span> / Revenue</span>
        </div>
        <section class="order-container" style="padding:20px; min-height:0">
            <h1 class="heading">Tổng Doanh Thu (Ngày)</h1>
            <div class="box-container revenue" style="padding-bottom:20px">
                <form method="POST">
                    <label for="date">Chọn ngày:</label>
                    <input type="date" name="date" id="date" value="<?= htmlspecialchars($selected_date); ?>" required>
                    <button style="margin-top: 15px; cursor: pointer; border-radius:20px" type="submit">Xem doanh thu</button>
                </form>
                <?php
                $grand_total_delivered = 0;
                $grand_total_canceled = 0;

                // Lấy tổng doanh thu từ các Orders hàng có trạng thái 'delivered' trong ngày được chọn
                $select_delivered = $conn->prepare("
                    SELECT SUM(price) AS total_revenue 
                    FROM orders 
                    WHERE status = 'delivered' AND DATE(date) = :date
                ");
                $select_delivered->bindParam(':date', $selected_date, PDO::PARAM_STR);
                $select_delivered->execute();
                $result_delivered = $select_delivered->fetch(PDO::FETCH_ASSOC);
                $grand_total_delivered = $result_delivered['total_revenue'] ?? 0;

                // Lấy tổng tiền từ các Orders hàng có trạng thái 'canceled' trong ngày được chọn
                $select_canceled = $conn->prepare("
                    SELECT SUM(price) AS total_revenue 
                    FROM orders 
                    WHERE status = 'canceled-nv' AND DATE(date) = :date
                ");
                $select_canceled->bindParam(':date', $selected_date, PDO::PARAM_STR);
                $select_canceled->execute();
                $result_canceled = $select_canceled->fetch(PDO::FETCH_ASSOC);
                $grand_total_canceled = $result_canceled['total_revenue'] ?? 0;

                // Lấy số lượng Orders hàng thành công và hủy
                $select_successful_orders = $conn->prepare("
                    SELECT COUNT(*) AS order_count 
                    FROM orders 
                    WHERE status = 'delivered' AND DATE(date) = :date
                ");
                $select_successful_orders->bindParam(':date', $selected_date, PDO::PARAM_STR);
                $select_successful_orders->execute();
                $result_successful_orders = $select_successful_orders->fetch(PDO::FETCH_ASSOC);
                $successful_order_count = $result_successful_orders['order_count'] ?? 0;
                // Orders khởi tạo
                $select_intial_orders = $conn->prepare("

                    SELECT COUNT(*) AS order_count 
                    FROM orders 
                    WHERE status = 'initial' AND DATE(date) = :date
                ");
                $select_intial_orders->bindParam(':date', $selected_date, PDO::PARAM_STR);
                $select_intial_orders->execute();
                $result_intial_orders = $select_intial_orders->fetch(PDO::FETCH_ASSOC);
                $intial_order_count = $result_intial_orders['order_count'] ?? 0;
                // Orders đang làm
                $select_inprogress_orders = $conn->prepare("
                    SELECT COUNT(*) AS order_count 
                    FROM orders 
                    WHERE status = 'in progress' AND DATE(date) = :date
                ");
                $select_inprogress_orders->bindParam(':date', $selected_date, PDO::PARAM_STR);
                $select_inprogress_orders->execute();
                $result_inprogress_orders = $select_inprogress_orders->fetch(PDO::FETCH_ASSOC);
                $inprogress_order_count = $result_inprogrerss_orders['order_count'] ?? 0;
                // Orders bị hủy
                $select_canceled2_orders = $conn->prepare("
                    SELECT COUNT(*) AS order_count 
                    FROM orders 
                    WHERE status = 'canceled-kh' AND DATE(date) = :date
                ");
                $select_canceled2_orders->bindParam(':date', $selected_date, PDO::PARAM_STR);
                $select_canceled2_orders->execute();
                $result_canceled2_orders = $select_canceled2_orders->fetch(PDO::FETCH_ASSOC);
                $canceled2_order_count = $result_canceled2_orders['order_count'] ?? 0;
                //Orders bị bom
                $select_canceled_orders = $conn->prepare("
                    SELECT COUNT(*) AS order_count 
                    FROM orders 
                    WHERE status = 'canceled-nv' AND DATE(date) = :date
                ");
                $select_canceled_orders->bindParam(':date', $selected_date, PDO::PARAM_STR);
                $select_canceled_orders->execute();
                $result_canceled_orders = $select_canceled_orders->fetch(PDO::FETCH_ASSOC);
                $canceled_order_count = $result_canceled_orders['order_count'] ?? 0;

                if ($grand_total_delivered == 0 && $grand_total_canceled == 0) {
                    echo '<div class="empty"><p>Không có dữ liệu doanh thu trong ngày này.</p></div>';
                } else {
                ?>
                    <div class="total">
                        <div class="label_total">
                            <h3 style="color: var(--green);">Tổng doanh thu Orders thành công trong ngày <?= htmlspecialchars($selected_date); ?>:</h3>
                            <div style="color: #2ecc71;"><?= number_format($grand_total_delivered, 0, '.', '.'); ?>đ</div>
                        </div>
                        <div class="label_total">
                            <h3 style="color: var(--green);">Tổng tiền Orders bị bom trong ngày <?= htmlspecialchars($selected_date); ?>:</h3>
                            <div style="color: #c0392b;"><?= number_format($grand_total_canceled, 0, '.', '.'); ?>đ</div>
                        </div>
                    </div>

                    <!-- Table to display order counts -->
                    <div class="order-counts">
                        <table style="width: 100%; margin-top: 20px; font-size:28px; width:776px; border: 1px solid #87A24E ">
                            <thead>
                                <tr>
                                    <th style="border-bottom: 1px solid #87A24E; padding:20px; border-right: 1px solid #87A24E;">Loại Orders hàng</th>
                                    <th style="border-bottom: 1px solid #87A24E; padding:20px; text-align: center">Số lượng Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border-bottom: 1px solid #87A24E; padding:20px; border-right: 1px solid #87A24E;">Orders thành công</td>
                                    <td style="border-bottom: 1px solid #87A24E; padding:20px;text-align: center "><?= number_format($successful_order_count); ?></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #87A24E; padding:20px;border-right: 1px solid #87A24E;">Orders bị hủy</td>
                                    <td style="border-bottom: 1px solid #87A24E; padding:20px;text-align: center"><?= number_format($canceled2_order_count); ?></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #87A24E; padding:20px;border-right: 1px solid #87A24E;">Orders bị bom</td>
                                    <td style="border-bottom: 1px solid #87A24E; padding:20px;text-align: center"><?= number_format($canceled_order_count); ?></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #87A24E; padding:20px; border-right: 1px solid #87A24E;">Orders đang làm </td>
                                    <td style="border-bottom: 1px solid #87A24E; padding:20px;text-align: center"><?= number_format($inprogress_order_count); ?></td>
                                </tr>
                                <tr>
                                    <td style=" padding:20px;border-right: 1px solid #87A24E;">Orders vừa khởi tạo </td>
                                    <td style=" padding:20px;text-align: center"><?= number_format($intial_order_count); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>

        <section class="order-container" style="margin-top:0px;">
            <form method="POST">
                <label for="period_option">khoảng thời gian:</label>
                <select name="period_option" id="period_option" onchange="this.form.submit(); toggleDateSelection();">
                    <option value="week" <?= $period_option == 'week' ? 'selected' : ''; ?>>Tuần</option>
                    <!-- <option value="month" <?= $period_option == 'month' ? 'selected' : ''; ?>>Tháng</option>
                    <option value="year" <?= $period_option == 'year' ? 'selected' : ''; ?>>Năm</option> -->
                </select>
            </form>

            <h1 class="heading">So sánh Doanh Thu
                (<?php
                    if ($period_option == 'month') {
                        echo 'Tháng';
                    } elseif ($period_option == 'year') {
                        echo 'Năm';
                    } else {
                        echo 'Tuần';
                    }
                    ?>)
            </h1>

            <div class="box-container revenue">
                <form method="POST" id="week_selection" style="display:none;">
                    <!-- Tuần: chọn ngày bắt đầu và ngày kết thúc -->
                    <div>
                        <label for="start_date">Chọn ngày bắt đầu:</label>
                        <input type="date" name="start_date" id="start_date" value="<?= htmlspecialchars($selected_start_date); ?>" onchange="updateEndDate()" required>
                        <label for="end_date">Chọn ngày kết thúc:</label>
                        <input type="date" name="end_date" id="end_date" value="<?= htmlspecialchars($selected_end_date); ?>" required>
                    </div>
                    <button style="margin-top: 15px; cursor: pointer; border-radius:20px" type="submit">Xem doanh thu</button>
                </form>
                <form method="POST" id="month_selection" style="display:none;">
                    <!-- Tháng: chỉ chọn năm -->
                    <div>
                        <label for="year">Chọn năm:</label>
                        <input type="number" name="year" id="year" value="<?= htmlspecialchars($selected_year); ?>" required>
                    </div>
                    <button style="margin-top: 15px; cursor: pointer; border-radius:20px" type="submit">Xem doanh thu</button>
                </form>
                <form method="POST" id="year_selection" style="display:none;">
                    <!-- Năm: chọn năm bắt đầu và kết thúc -->
                    <div>
                        <label for="start_year">Chọn năm bắt đầu:</label>
                        <input type="number" name="start_year" id="start_year" value="<?= htmlspecialchars($start_year); ?>" required>
                        <label for="end_year">Chọn năm kết thúc:</label>
                        <input type="number" name="end_year" id="end_year" value="<?= htmlspecialchars($end_year); ?>" required>
                    </div>

                    <button style="margin-top: 15px; cursor: pointer; border-radius:20px" type="submit">Xem doanh thu</button>
                </form>

                <!-- code xử lý tuần tháng năm -->
                <?php
                // Handle revenue based on selected period
                $revenue_data = [];
                $failed_order_data = []; // Dữ liệu cho doanh thu từ đơn hàng bị bom

                if ($period_option == 'week') {
                    $date = new DateTime($selected_start_date);
                    $dateInterval = new DateInterval('P1D');
                    while ($date <= new DateTime($selected_end_date)) {
                        $current_date = $date->format('Y-m-d');

                        // Doanh thu từ các đơn hàng thành công
                        $select_data = $conn->prepare("
                        SELECT SUM(price) AS total_revenue
                        FROM orders
                        WHERE status = 'delivered' AND DATE(date) = :date
                    ");
                        $select_data->bindParam(':date', $current_date, PDO::PARAM_STR);
                        $select_data->execute();
                        $result_data = $select_data->fetch(PDO::FETCH_ASSOC);
                        $revenue_data[$current_date] = $result_data['total_revenue'] ?? 0;

                        // Doanh thu từ các đơn hàng bị bom (hủy hoặc thất bại)
                        $select_failed_data = $conn->prepare("
                        SELECT SUM(price) AS failed_revenue
                        FROM orders 
                        WHERE status IN ('canceled-nv', 'failed') AND DATE(date) = :date
                    ");
                        $select_failed_data->bindParam(':date', $current_date, PDO::PARAM_STR);
                        $select_failed_data->execute();
                        $result_failed_data = $select_failed_data->fetch(PDO::FETCH_ASSOC);
                        $failed_order_data[$current_date] = $result_failed_data['failed_revenue'] ?? 0;

                        $date->add($dateInterval);
                    }
                } elseif ($period_option == 'month') {
                    // Doanh thu từ các đơn hàng thành công mỗi tháng
                    $select_data = $conn->prepare("
                    SELECT MONTH(date) AS month, SUM(price) AS total_revenue
                    FROM orders
                    WHERE status = 'delivered' AND YEAR(date) = :year
                    GROUP BY MONTH(date)
                ");
                    $select_data->bindParam(':year', $selected_year, PDO::PARAM_INT);
                    $select_data->execute();
                    while ($row = $select_data->fetch(PDO::FETCH_ASSOC)) {
                        $revenue_data[$row['month']] = $row['total_revenue'] ?? 0;
                    }

                    // Doanh thu từ các đơn hàng bị bom mỗi tháng
                    $select_failed_data = $conn->prepare("
                    SELECT MONTH(date) AS month, SUM(price) AS failed_revenue
                    FROM orders 
                    WHERE status IN ('canceled', 'failed') AND YEAR(date) = :year
                    GROUP BY MONTH(date)
                ");
                    $select_failed_data->bindParam(':year', $selected_year, PDO::PARAM_INT);
                    $select_failed_data->execute();
                    while ($row = $select_failed_data->fetch(PDO::FETCH_ASSOC)) {
                        $failed_order_data[$row['month']] = $row['failed_revenue'] ?? 0;
                    }
                } elseif ($period_option == 'year') {
                    for ($year = $start_year; $year <= $end_year; $year++) {
                        // Doanh thu từ các đơn hàng thành công mỗi năm
                        $select_data = $conn->prepare("
                        SELECT SUM(price) AS total_revenue
                        FROM orders
                        WHERE status = 'delivered-' AND YEAR(date) = :year
                        GROUP BY YEAR(date)
                    ");
                        $select_data->bindParam(':year', $year, PDO::PARAM_INT);
                        $select_data->execute();
                        $result_data = $select_data->fetch(PDO::FETCH_ASSOC);
                        $revenue_data[$year] = $result_data['total_revenue'] ?? 0;

                        // Doanh thu từ các đơn hàng bị bom mỗi năm
                        $select_failed_data = $conn->prepare("
                        SELECT SUM(price) AS failed_revenue
                        FROM orders 
                        WHERE status IN ('canceled-nv') AND YEAR(date) = :year
                    ");
                        $select_failed_data->bindParam(':year', $year, PDO::PARAM_INT);
                        $select_failed_data->execute();
                        $result_failed_data = $select_failed_data->fetch(PDO::FETCH_ASSOC);
                        $failed_order_data[$year] = $result_failed_data['failed_revenue'] ?? 0;
                    }
                }

                ?>

                <canvas id="revenueChart" width="400" height="200"></canvas>
                <!-- Vẽ biểu đồ doanh thu -->
                <script>
                    // Prepare data for the chart
                    const revenueData = <?php echo json_encode($revenue_data); ?>;
                    const failedOrderData = <?php echo json_encode($failed_order_data); ?>;
                    const labels = Object.keys(revenueData); // Use the keys (dates/months/years) as labels
                    const revenueValues = Object.values(revenueData); // Use the values (revenue) for the chart
                    const failedOrderValues = Object.values(failedOrderData); // Use the failed order revenue values

                    // Create the chart
                    const ctx = document.getElementById('revenueChart').getContext('2d');
                    const revenueChart = new Chart(ctx, {
                        type: 'line', // Line chart for revenue
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'Orders complete',
                                    data: revenueValues,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Orders uncomplete-nv',
                                    data: failedOrderValues, // Use the failed order revenue values
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return value.toLocaleString(); // Format numbers with commas
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>

            </div>
        </section>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="backend.js"></script>
    <?php include 'alert.php'; ?>
</body>

</html>
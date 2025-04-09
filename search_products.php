<?php
if (isset($_GET['q']) && !empty($_GET['q'])) {  // Kiểm tra nếu tham số 'q' tồn tại và không rỗng
    $query = $_GET['q'];  // Lấy tham số tìm kiếm từ URL

    // Kết nối với database
    include 'connect.php';  // Đảm bảo tệp connect.php chứa thông tin kết nối đúng

    try {
        // Tránh SQL Injection bằng cách sử dụng prepared statement
        $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
        $stmt->execute(['%' . $query . '%']);
        
        // Lấy danh sách sản phẩm
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Nếu không tìm thấy sản phẩm, trả về mảng rỗng
        if (empty($products)) {
            echo json_encode([]);
        } else {
            // Trả về kết quả dưới dạng JSON
            echo json_encode($products);
        }
    } catch (PDOException $e) {
        // Xử lý lỗi kết nối hoặc truy vấn
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Nếu không có tham số tìm kiếm hoặc tham số rỗng, trả về mảng rỗng
    echo json_encode([]);
}
?>

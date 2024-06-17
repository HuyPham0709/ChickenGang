<?php
include('../admin/includes/header.php');
include('../admin/db.php');

// Hàm escape string an toàn
function escape_string($con, $value) {
    return $con->real_escape_string($value);
}

// Lấy danh sách các năm có trong bảng revenue
$sql_years = "SELECT DISTINCT year FROM revenue ORDER BY year";
$result_years = $con->query($sql_years);

$years = [];
if ($result_years->num_rows > 0) {
    while ($row = $result_years->fetch_assoc()) {
        $years[] = $row['year'];
    }
} else {
    die("Không có dữ liệu trong bảng doanh thu.");
}

// Xử lý năm được chọn
$selected_year = isset($_GET['year']) ? escape_string($con, $_GET['year']) : $years[0];

// Truy vấn SQL để lấy dữ liệu dựa trên năm đã chọn
$sql_revenue = "SELECT month, SUM(amount) as total_revenue FROM revenue WHERE year = ? GROUP BY month ORDER BY month";
$stmt = $con->prepare($sql_revenue);
$stmt->bind_param('s', $selected_year);
$stmt->execute();
$result = $stmt->get_result();

$months = [];
$total_revenues = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $months[] = $row['month'];
        $total_revenues[] = $row['total_revenue'];
    }
} else {
    echo "Không có kết quả!";
}

$stmt->close();

// Hàm cập nhật hoặc thêm dữ liệu vào bảng revenue từ bảng cart
function updateRevenueFromCart($con) {
    $sql_update = "INSERT INTO revenue (id_cart, month, year, amount)
                   SELECT id_Cart, MONTH(order_date) AS month, YEAR(order_date) AS year, SUM(total_money) AS total_amount
                   FROM cart
                   GROUP BY MONTH(order_date), YEAR(order_date), id_Cart
                   ON DUPLICATE KEY UPDATE amount = VALUES(amount)";
    if (!$con->query($sql_update)) {
        echo "Lỗi: " . $con->error;
    }
}

// Gọi hàm cập nhật dữ liệu từ bảng cart vào bảng revenue
updateRevenueFromCart($con);

$con->close();
?>

<!-- Content Row -->
<div class="row">
    <!-- Form chọn năm -->
    <div class="col-xl-12">
        <form method="get">
            <label for="year">Chọn Năm:</label>
            <select id="year" name="year" onchange="this.form.submit()">
                <?php
                foreach ($years as $year) {
                    $selected = ($year == $selected_year) ? 'selected' : '';
                    echo "<option value=\"$year\" $selected>$year</option>";
                }
                ?>
            </select>
        </form>
    </div>

    <!-- Column Chart -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tổng Quan Doanh Thu cho <?php echo $selected_year; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myBarChart" style="width: 100%; height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var months = <?php echo json_encode($months); ?>;
    var total_revenues = <?php echo json_encode($total_revenues); ?>;

    var ctx = document.getElementById('myBarChart').getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'bar', // Đổi sang biểu đồ cột
        data: {
            labels: months,
            datasets: [{
                label: 'Tổng Doanh Thu (VND)',
                data: total_revenues,
                backgroundColor: 'rgba(78, 115, 223, 0.5)', // Màu của cột
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Tháng'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Tổng Doanh Thu (VND)'
                    }
                }
            }
        }
    });
</script>

<!-- End of Main Content -->
<?php include('../admin/includes/footer.php'); ?>

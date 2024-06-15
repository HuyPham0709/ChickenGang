<?php
include('../admin/includes/header.php');
include('../admin/db.php');

// Lấy danh sách các năm có trong bảng revenue
$years_result = $con->query("SELECT DISTINCT year FROM revenue ORDER BY year");
$years = [];
while ($row = $years_result->fetch_assoc()) {
    $years[] = $row['year'];
}

// Kiểm tra nếu danh sách các năm trống
if (empty($years)) {
    die("No data available in the revenue table.");
}

$selected_year = isset($_GET['year']) ? $_GET['year'] : $years[0];

// Truy vấn SQL để lấy dữ liệu dựa trên năm đã chọn
$sql = "SELECT month, SUM(amount) as total_revenue FROM revenue WHERE year = '$selected_year' GROUP BY month ORDER BY month";
$result = $con->query($sql);

$months = [];
$total_revenues = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $months[] = $row['month'];
        $total_revenues[] = $row['total_revenue'];
    }
} else {
    echo "No results found!";
}

// Hàm cập nhật hoặc thêm dữ liệu vào bảng revenue từ bảng cart
function updateRevenueFromCart($con) {
    $sql = "SELECT MONTH(order_date) AS month, YEAR(order_date) AS year, SUM(total_money) AS total_amount, id_Cart FROM cart GROUP BY MONTH(order_date), YEAR(order_date), id_Cart";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $month = $row['month'];
            $year = $row['year'];
            $total_amount = $row['total_amount'];
            $id_cart = $row['id_Cart'];

            // Kiểm tra xem id_cart có tồn tại trong bảng revenue chưa
            $check_sql = "SELECT id_cart FROM revenue WHERE id_cart = '$id_cart'";
            $check_result = $con->query($check_sql);
            if ($check_result->num_rows == 0) {
                // Thêm dữ liệu vào bảng revenue
                $insert_sql = "INSERT INTO revenue (id_cart, month, year, amount) VALUES ('$id_cart', '$month', '$year', '$total_amount')";
                if (!$con->query($insert_sql)) {
                    echo "Error: " . $con->error;
                }
            }
        }
    } else {
        echo "No results found!";
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
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview for <?php echo $selected_year; ?></h6>
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
                        text
                        : 'Tổng Doanh Thu (VND)'
                    }
                }
            }
        }
    });
</script>

<!-- End of Main Content -->
<?php include('../admin/includes/footer.php'); ?>

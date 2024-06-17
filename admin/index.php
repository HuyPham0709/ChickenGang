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

// Truy vấn tổng số người dùng đã đăng nhập
$sql_total_users = "SELECT COUNT(*) AS total_users FROM login";
$result_total_users = $con->query($sql_total_users);
$row_total_users = $result_total_users->fetch_assoc();
$total_users = $row_total_users['total_users'];

// Truy vấn tổng số lượng sản phẩm
$sql_total_quantity = "SELECT SUM(quantity) AS total_quantity FROM products";
$result_total_quantity = $con->query($sql_total_quantity);
$row_total_quantity = $result_total_quantity->fetch_assoc();
$total_quantity = $row_total_quantity['total_quantity'];

// Lấy danh sách năm có trong dữ liệu
$sql_years = "SELECT DISTINCT YEAR(order_date) AS year FROM cart ORDER BY year";
$result_years = $con->query($sql_years);

$years = [];
while ($row_year = $result_years->fetch_assoc()) {
    $years[] = $row_year['year'];
}

// Lấy năm được chọn, nếu không có mặc định là năm hiện tại
$selected_year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Truy vấn dữ liệu doanh thu theo tháng của năm được chọn
$sql_revenue = "
    SELECT 
        DATE_FORMAT(order_date, '%Y-%m') AS month_year, 
        SUM(total_money) AS revenue 
    FROM cart 
    WHERE YEAR(order_date) = ?
    GROUP BY month_year 
    ORDER BY month_year";

$stmt_revenue = $con->prepare($sql_revenue);
$stmt_revenue->bind_param("i", $selected_year);
$stmt_revenue->execute();
$result_revenue = $stmt_revenue->get_result();


$months = [];
$revenues = [];

if ($result_revenue->num_rows > 0) {
    while ($row = $result_revenue->fetch_assoc()) {
        $months[] = $row['month_year'];
        $revenues[] = $row['revenue'];
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

    echo "Không có kết quả.";
}
}
$stmt_revenue->close();

// Truy vấn dữ liệu số lượng sản phẩm theo collection
$sql_collection = "
    SELECT 
        collection, 
        SUM(quantity) AS total_quantity 
    FROM products 
    GROUP BY collection 
    ORDER BY collection";

$result_collection = $con->query($sql_collection);

$collections = [];
$quantities = [];

if ($result_collection->num_rows > 0) {
    while ($row = $result_collection->fetch_assoc()) {
        $collections[] = $row['collection'];
        $quantities[] = $row['total_quantity'];

    }
} else {
    echo "Không có kết quả.";
}


// Gọi hàm cập nhật dữ liệu từ bảng cart vào bảng revenue
updateRevenueFromCart($con);


$con->close();

// Chuyển đổi dữ liệu thành JSON
$months_json = json_encode($months);
$revenues_json = json_encode($revenues);
$collections_json = json_encode($collections);
$quantities_json = json_encode($quantities);
?>

<div class="row">
    <!-- Tổng số lượng người dùng đã đăng nhập -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Người Dùng Đã Đăng Nhập</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_users; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Tổng số lượng sản phẩm -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Tổng Số Lượng Sản Phẩm</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_quantity; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form chọn năm -->
<div class="row">
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
</div>

<!-- Biểu đồ Line Chart -->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                <h6 class="m-0 font-weight-bold text-primary">Tổng Quan Doanh Thu cho <?php echo $selected_year; ?></h6>
=======
                <h6 class="m-0 font-weight-bold text-primary">Tổng Doanh Thu Theo Tháng <?php echo $selected_year; ?></h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myLineChart" style="width: 100%; height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Biểu đồ Bar Chart cho Số Lượng Sản Phẩm Theo Collection -->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Số Lượng Sản Phẩm Theo Collection</h6>

            </div>
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
    // Dữ liệu cho biểu đồ Line Chart (Tổng Doanh Thu)
    var months = <?php echo $months_json; ?>;
    var revenues = <?php echo $revenues_json; ?>;

    var ctxLine = document.getElementById('myLineChart').getContext('2d');
    var myLineChart = new Chart(ctxLine, {
        type: 'line', // Loại biểu đồ: Line
        data: {
            labels: months,
            datasets: [{
                label: 'Tổng Doanh Thu (VND)',
                data: revenues,
                backgroundColor: 'rgba(78, 115, 223, 0.2)', // Màu nền của đường
                borderColor: 'rgba(78, 115, 223, 1)', // Màu của đường
                borderWidth: 2,
                fill: true
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

    // Dữ liệu cho biểu đồ Bar Chart (Số Lượng Sản Phẩm Theo Collection)
    var collections = <?php echo $collections_json; ?>;
    var quantities = <?php echo $quantities_json; ?>;

    var ctxBar = document.getElementById('myBarChart').getContext('2d');
    var myBarChart = new Chart(ctxBar, {
        type: 'bar', // Loại biểu đồ: Bar
        data: {
            labels: collections,
            datasets: [{
                label: 'Số Lượng Sản Phẩm',
                data: quantities,
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Màu của cột
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Collection'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Số Lượng Sản Phẩm'
                    }
                }
            }
        }
    });
</script>
<?php include('../admin/includes/footer.php'); ?>
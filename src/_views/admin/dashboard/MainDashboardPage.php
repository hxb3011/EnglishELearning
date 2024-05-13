<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
final class MainDashboardPage extends BaseHTMLDocumentPage
{
    public function __construct()
    {
        parent::__construct();
    }
    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Quản lý - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Quản lý - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css",
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css",
            // "/node_modules/toastr/build/toastr.css",
            "/clients/css/admin/main.css",
            "/clients/css/admin/dashboard.css"
        );
        $this->scripts(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",
        );
    }

    public function body()
    {
        ?>
        <!-- Bắt đầu cục tổng quan -->
        <div class="row">
            <div class="filter-date d-flex justify-content-start mb-3 text-dark">
                <div class="mx-1">
                    <label for="start-date">Từ</label>
                    <input type="date" id="start-date" min="2024-01-01">
                </div>
                <div class="mx-1">
                    <label for="end-date">Đến</label>
                    <input type="date" id="end-date" min="2023-01-01">
                </div>
            </div>
            <h4 class="card-title mb-3 text-dark">Tổng quan</h4>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient bg-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="../../../assets/images/circle.svg" class="card-img-absolute" alt="circle-image">
                        <h4 class="font-weight-normal mb-3">Tổng thu nhập <i class="fa-solid fa-chart-line"></i>
                        </h4>
                        <h2 class="mb-5" id="total-revenue">
                            0 đ
                        </h2>
                        <!-- <h6 class="card-text">Giảm khoảng 60%</h6> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-info bg-gradient card-img-holder text-white">
                    <div class="card-body">
                        <img src="../../../assets/images/circle.svg" class="card-img-top" alt="circle-image">
                        <h4 class="font-weight-normal mb-3">Khóa học đã bán <i class="fa-solid fa-cart-shopping"></i>
                        </h4>
                        <h2 class="mb-5" id="total_buyed_course">
                            0 Khóa
                        </h2>
                        <!-- <h6 class="card-text">Tăng khoảng 30%</h6> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient bg-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="../../../assets/images/circle.svg" class="card-img-top" alt="circle-image">
                        <h4 class="font-weight-normal mb-3">Người dùng <i class="fa-solid fa-user-plus"></i>
                        </h4>
                        <h2 class="mb-5" id="total_account">
                            0 Tài khoản
                        </h2>
                        <!-- <h6 class="card-text">Tăng khoảng 5%</h6> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Kết thúc cục tổng quan -->

        <!-- Bắt đầu biểu đồ thu nhập -->
        <div class="card" style="margin-bottom: 40px">
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <h4 class="card-title">Thống kê hóa đơn</h4>
                <canvas id="line-chart" style="height: 407px; display: block; width: 815px;" width="815" height="407" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
        <!-- Kết thúc biểu đồ thu nhập -->

        <!-- Bắt đầu bảng giảng viên -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-group d-flex justify-content-between mb-3">
                        <h3 class="card-title">Top
                            <span id="quantity-number"></span>
                            giảng viên thu nhập cao nhất
                        </h3>
                        <span class="view-quantity">
                            Hiển thị
                            <input type="number" id="view-teacher-quantity" class="view-teacher-quantity" title="Top giảng viên" value="5" max="5" min="1">
                            Giảng viên
                        </span>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr style="text-align: center">
                                <th> Họ Tên </th>
                                <th style="text-align: center"> Đã bán </th>
                                <th> Thu nhập </th>
                                <th> Số học viên tham gia </th>
                            </tr>
                        </thead>
                        <tbody id="table-teacher">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- kết thúc bảng giảng viên -->

        <!-- Bắt đầu bảng khóa học -->
        <div class="card">
            <div class="card-body">
                <div class="card-group d-flex justify-content-between mb-3">
                    <h3 class="card-title">Top
                    <span id="quantity-course-number"></span>
                    khóa học bán chạy nhất</h3>
                    <span class="view-quantity">
                        Hiển thị
                        <input type="number" id="view-top-course-quantity" class="view-course-quantity" title="Top Khóa Học" value="5" max="5" min="1">
                        Khóa Học
                    </span>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: center">
                            <th> Tên khóa học</th>
                            <th> Giảng viên </th>
                            <th> Giá </th>
                            <th> Số lượng đã bán </th>
                            <th> Cập nhập lần cuối </th>
                        </tr>
                    </thead>
                    <tbody id="table-top-course">
                        <!-- @foreach ($top_course as $course) -->
                        <!-- <tr style="text-align: center">
                            <td style="text-align: left">
                                <a href="" style="text-decoration: none; color:black">
                                    {{ $course->name }}
                                </a>
                            </td>
                            <td style="text-align: left">
                                <a href="" style="text-decoration: none; color:black">
                                    {{ $course->name_admin }}
                                </a>
                            </td>
                            <td>
                                {{ number_format($course->price, 0, '', ',') }} đ
                            </td>
                            <td>
                                {{ $course->number_order }} khóa
                            </td>
                            <td>
                                {{ date('d-m-Y', strtotime($course->updated_at)) }}
                            </td>
                        </tr> -->
                        <!-- @endforeach -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Kết thúc bảng khóa học -->
<?
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js",
            "https://cdn.jsdelivr.net/npm/chart.js",
            // "/node_modules/toastr/build/toastr.min.js",
            "/clients/js/admin/dashboard.js"
        );
    }
}

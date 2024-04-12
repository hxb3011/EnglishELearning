<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
class ManageAllCoursePage extends BaseHTMLDocumentPage
{
    public function __construct()
    {
        parent::__construct();
    }
    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Hồ sơ - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Hồ sơ - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css",
            "/clients/css/admin/main.css"
        );
        $this->scripts(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",
        );
    }

    public function body()
    {
?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="admin-header">
                        <i class="mdi mdi-apple-keyboard-command admin-header__icon"></i>
                        Danh sách khóa học
                    </div>
                </div>
            </div>
            <div style="margin-top:10px; margin-bottom:10px"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="filter-section row">
                                <div class="filter-part d-flex align-items-center justify-content-center  col-md-4 col-sm-12  ">
                                    <span class="filter-text">
                                        Giảng viên
                                    </span>
                                    <select class="form-select" name="giangvien " id="giangvien">
                                        <option value="">Lựa chọn giảng viên</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select>
                                </div>
                                <div class="filter-part d-flex align-items-center justify-content-center col-md-4 col-sm-12 ">
                                    <span class="filter-text">
                                        Gía
                                    </span>
                                    <select class="form-select" name="gia" id="gia">
                                        <option value="">Lựa chọn giá</option>
                                        <option value="">Miễn phí</option>
                                        <option value="">Miễn phí</option>
                                    </select>
                                </div>
                                <div class="filter-part d-flex align-items-center justify-content-center col-md-4 col-sm-12   ">
                                    <button class="btn  filter-btn">
                                        Lọc
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên khóa</th>
                                                <th scope="col">Giảng viên</th>
                                                <th scope="col">Thời gian</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>
                                                    Ngày bắt đầu <br/>
                                                    Ngày kết thúc 
                                                </td>
                                                <td>
                                                    <span class="badge text-bg-success">Active</span>
                                                    <span class="badge text-bg-danger">InActive</span>
                                                </td>
                                                <td>
                                                    <span class="badge text-bg-secondary">10 VNĐ</span>
                                                </td>
                                                <td>
                                                    <div class="dropright">
                                                        <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="/courses/detail.php" target="_blank">Xem khóa học</a></li>
                                                            <li><a class="dropdown-item" href="/administration/courses/edit.php">Sửa khóa học</a></li>
                                                            <li><a class="dropdown-item" href="javascript::" onclick="">Xóa</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js",
            "/clients/js/admin/main.js"
        );
    }
    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}

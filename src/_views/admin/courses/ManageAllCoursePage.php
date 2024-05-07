<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
class ManageAllCoursePage extends BaseHTMLDocumentPage
{
    public $courses = array();
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
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/node_modules/toastr/build/toastr.css",
            "/node_modules/sweetalert2/dist/sweetalert2.min.css",
            "/clients/css/admin/main.css"
        );
    }

    public function body()
    {
?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="admin-header">
                        <span class="mdi-b apple-keyboard-command admin-header__icon"></span>
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
                                        <tbody id="table_body">
                                            <? if($this->courses != null): ?>
                                                <?php
                                                foreach ($this->courses as $index => $course) :
                                                ?>
                                                    <tr>
                                                        <th scope="row"><? echo ($index + 1) ?></th>
                                                        <td><? echo ($course->name) ?></td>
                                                        <td><? echo ($course->tutorName) ?></td>
                                                        <td>
                                                            Ngày bắt đầu : <? echo ($course->beginDate->format('d-m-Y')); ?>
                                                            <br />
                                                            Ngày kết thúc : <? echo ($course->endDate->format('d-m-Y')); ?>
                                                        </td>
                                                        <td>
                                                            <? if ($course->state == 1) : ?>
                                                                <span class="badge text-bg-success">Hoạt động</span>
                                                            <? else : ?>
                                                                <span class="badge text-bg-danger">Ngưng</span>
                                                            <? endif ?>
                                                        </td>
                                                        <td>
                                                            <span class="badge text-bg-secondary"><? echo ($course->price); ?> VNĐ</span>
                                                        </td>
                                                        <td>
                                                            <div class="dropright">
                                                                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <span class="mdi-b dots-vertical"></span>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="/courses/detail.php/<?echo $course->id?>" target="_blank">Xem khóa học</a></li>
                                                                    <li><a class="dropdown-item" href="/administration/courses/edit.php?courseId=<?echo $course->id?>">Sửa khóa học</a></li>
                                                                    <li><a class="dropdown-item" onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_course&courseId=<? echo ($course->id); ?>','Xóa khóa học')">Xóa khóa học</a></li>

                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <? endif?>
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
            "/node_modules/jquery/dist/jquery.min.js",
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
            "/node_modules/toastr/build/toastr.min.js",
            "/node_modules/sweetalert2/dist/sweetalert2.min.js",
            "/clients/js/admin/main.js"
        );
    }
    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}

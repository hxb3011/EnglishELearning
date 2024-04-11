<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class AllCoursesPage extends BaseHTMLDocumentPage
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
        parent::documentInfo($author, $description, "Tất cả khóa học - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Tất cả khóa học - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css",
            "/clients/css/home/home_main.css",
            "/clients/css/courses/all-courses.css",
            "/clients/css/pagination.css"
        );
        $this->scripts(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",
        );
    }
    public function body()
    {
?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="courses-section__head d-flex justify-content-between align-items-center">
                        <h3 class="courses-section__header">
                            Tất cả khóa học
                        </h3>
                        <div class="courses-section__header__search-wrapper d-flex align-items-center" style="width : 18%">
                            <form style="display:block; width:100%" class="courses-section__header__search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm..." id="search" style="font-size: 8rem;">
                                    <div class="input-group-append">
                                        <button class="btn btn-search " type="button">
                                            <span class="mdi courses-section__header__search-icon"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
                    <div class="courses-section__content container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="courses-section__content__course-item">
                                    <img src="/assets/images/blog4.png" class="courses-section__content__course-item-image">
                                    </img>
                                    <div class="courses-section__content__course-item__info d-flex justify-content-between flex-column">
                                        <div>
                                            <div class="course-item__info-section pt-2 pb-4">
                                                <span class="course-item__info-section__author">GV: Nguyễn Thanh Sang</span>
                                            </div>
                                            <p class="course-item__info-section__title">Create an LMS Website with LearnPress</p>
                                            <div class="d-flex align-items-center justify-content-evenly" style="margin-top: 4rem; margin-bottom:4rem;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="mini-icon">
                                                        <i class="mdi -calendar"></i>
                                                    </span>
                                                    <span class="course-item__info-section__text">
                                                        2 Tuần
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="mini-icon">
                                                        <i class=" mdi -student"></i>
                                                    </span>
                                                    <span class="course-item__info-section__text">
                                                        2 Học viên
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="mini-icon">
                                                        <i class="mdi -document"></i>
                                                    </span>
                                                    <span class="course-item__info-section__text">
                                                        20 Bài học
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between ps-3">
                                            <p class="course-item__info-section__price">3000000 VND</p>

                                            <a href="/courses/detail.php" class="course-item__info-section__link">Xem chi tiết</a>
                                        </div>
                                    </div>
                                    <div class="course-item_tag">
                                        Toeic
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="pagination">
                                    <li class="pagination-item">
                                        <a href="#">
                                            <i class="mdi -prev"></i>
                                        </a>
                                    </li>
                                    <li class=" pagination-item active">
                                        <a href="" class="pagination-item__link">1</a>
                                    </li>
                                    <li class="pagination-item">
                                        <a href="" class="pagination-item__link">2</a>
                                    </li>
                                    <li class="pagination-item">
                                        <a href="" class="pagination-item__link">3</a>
                                    </li>
                                    <li class="pagination-item">
                                        <a href="#">
                                            <i class="mdi -next"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        );
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>
<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class AllCoursesPage extends BaseHTMLDocumentPage
{
    public array $courses;
    public array $tutors;
    public string $basePath;
    public function __construct()
    {
        parent::__construct();
    }
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
        parent::favIcon("/assets/images/logo-icon.png", $svg);
    }

    public function head()
    {
        $this->styles(
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/clients/css/courses/all-courses.css",
            "/node_modules/toastr/build/toastr.css",
            "/clients/css/pagination.css"
        );
        $this->scripts(
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
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
                            Danh sách khóa học
                        </h3>
                    </div>
                    <div class="filter-section">
                        <div class="filter-part d-flex align-items-center justify-content-center col-lg-4 col-md-4 col-sm-12  ">
                            <input type="text" class="form-control" placeholder="Tìm kiếm theo tên" id="search">
                        </div>
                    </div>
                    <div class="filter-section row">
                        <div class="filter-part d-flex align-items-center justify-content-center  col-lg-4 col-md-4 col-sm-12  ">
                            <select class="form-select" name="giangvien " id="giangvien">
                                <option value="">Lựa chọn giảng viên</option>
                                <? foreach ($this->tutors as $index => $tutor) : ?>
                                    <option value="<? echo $tutor->getId() ?>"><? echo ($tutor->firstName . ' ' . $tutor->lastName) ?></option>
                                <? endforeach ?>
                            </select>
                        </div>
                        <div class="filter-part d-flex align-items-center justify-content-center col-lg-4 col-md-4 col-sm-12  ">
                            <input type="checkbox" name="is_price" id="is_price" style="margin-right:4rem;">
                            <div class="d-flex align-items-center justify-content-center">
                                <input type="number" class="form-control" name="start_price" id="start_price" placeholder="Giá từ" disabled> |
                                <input type="number" class="form-control" name="end_price" id="end_price" placeholder="Giá đến" disabled>
                            </div>
                        </div>
                        <div class="filter-part d-flex align-items-center justify-content-center col-lg-12 col-md-12 col-sm-12   ">
                            <button class="btn filter-btn" onclick="onClearData()" style="margin-right:12rem;">
                                Làm mới
                            </button>
                            <button class="btn filter-btn" onclick="onSearchData()">
                                Lọc
                            </button>
                        </div>
                    </div>
                    <div class="courses-section__content container-fluid" id="courses-section__content">
                        <? if ($this->courses != null) :  ?>
                            <? foreach ($this->courses as $index => $course) : ?>
                                <div class="row" style="<? if ($index > 0) echo "margin-top:14rem;" ?>">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="courses-section__content__course-item">
                                            <img src="<? echo ($this->basePath . $course->posterURI) ?>" class="courses-section__content__course-item-image">
                                            </img>
                                            <div class="courses-section__content__course-item__info d-flex justify-content-between flex-column">
                                                <div style="padding-top: 6rem; padding-bottom:6rem">
                                                    <div class="course-item__info-section pt-2 pb-4">
                                                        <span class="course-item__info-section__author">GV: <? echo $course->tutorName ?></span>
                                                    </div>
                                                    <p class="course-item__info-section__title"><? echo $course->name ?></p>
                                                    <div class="d-flex align-items-center justify-content-evenly" style=" flex-wrap: wrap;margin-top: 4rem; margin-bottom:4rem;">
                                                        <div class="d-flex justify-content-between align-items-center b">
                                                            <span class="mini-icon mdi-b calendar">
                                                            </span>
                                                            <span class="course-item__info-section__text">
                                                                <?
                                                                $interval = $course->beginDate->diff($course->endDate);
                                                                echo ($interval->days . ' Ngày')
                                                                ?>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center b">
                                                            <span class="mini-icon mdi-b student">
                                                            </span>
                                                            <span class="course-item__info-section__text">
                                                                2 Học viên
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center b ">
                                                            <span class="mini-icon mdi-b document">
                                                            </span>
                                                            <span class="course-item__info-section__text">
                                                                <?
                                                                echo (count($course->lessons) . 'Bài giảng')
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between ps-3" style="padding-bottom: 6rem; padding-right:8rem;">
                                                    <p class="course-item__info-section__price"><? echo $course->price ?> VND</p>

                                                    <a href="/courses/detail.php?courseId=<? echo $course->id ?>" class="course-item__info-section__link">Xem chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <? endforeach ?>
                        <? endif ?>

                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="pagination" id="pagination">
                                </ul>
                            </div>
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
        );
        ?>
        <script>
            var maxPage = 0;
            var tutor = '';
            var name = '';
            var start_price = 0;
            var end_price = 0;

            $(document).ready(function() {
                initPagination();
                $('#is_price').change(function() {
                    if ($(this).is(":checked")) {
                        $('#start_price').prop('disabled', false);
                        $('#end_price').prop('disabled', false);

                    } else {
                        $('#start_price').prop('disabled', true);
                        $('#end_price').prop('disabled', true);
                    }
                })

            })

            function setUpEvents() {
                $('.pagination-item').click(function() {
                    let targetPage = $(this).data('page');
                    let currentPage = +$('.pagination-item.active').data('page')

                    if (targetPage == 'prev') {
                        targetPage = currentPage - 1;
                        targetPage = (targetPage <= 0) ? targetPage = 1 : targetPage;
                    } else if (targetPage == 'next') {
                        targetPage = currentPage + 1;
                        targetPage = (targetPage > maxPage) ? targetPage = maxPage : targetPage;
                    }


                    targetPage = +targetPage;
                    let searchData = {
                        page: targetPage,
                        tutor: tutor,
                        name: name
                    }
                    if ($('#is_price').is(':checked')) {
                        searchData.start_price = start_price;
                        searchData.end_price = end_price;
                    }
                    if (targetPage != currentPage) {
                        $('.pagination-item.active').removeClass('active');
                        $('.pagination-item').each(function() {
                            if (+$(this).data('page') == targetPage) {
                                $(this).addClass('active')
                            }
                        })
                        $.ajax({
                            url: 'http://localhost:62280/courses/ajax_call_action.php?action=get_course_by_page',
                            method: 'POST',
                            data: JSON.stringify(searchData),
                            success: function(response) {
                                let data = JSON.parse(response);
                                console.log(data)
                                showData(data);
                            }
                        })
                    }

                })
            }

            function onClearData() {
                tutor = '';
                name = '';
                start_price = 0;
                end_price = 0;
                $('#start_price').prop('disabled', true);
                $('#end_price').prop('disabled', true);
                $('#start_price').val(undefined)
                $('#end_price').val(undefined)
                $('#is_price').prop("checked", false)
                $('#search').val("");
                $('#giangvien').prop('selectedIndex', 0);
                onSearchData();
            }

            function initPagination() {
                let searchData = {
                    tutor: tutor,
                    name: name,
                }
                if ($('#is_price').is(':checked')) {
                    searchData.start_price = start_price;
                    searchData.end_price = end_price;
                }
                $.ajax({
                    url: 'http://localhost:62280/courses/ajax_call_action.php?action=get_total_page',
                    method: 'POST',
                    data: JSON.stringify(searchData),
                    headers: {
                        'Access-Control-Allow-Origin': '*'
                    },
                    success: function(response) {
                        console.log(response, ' totalPage');
                        html = `
                       <li class="pagination-item" data-page="prev">
                                <a href="javascript:void(0)">
                                    <i class="mdi-b prev"></i>
                                </a>
                        </li>
                       `
                        for (let i = 0; i < +response; i++) {
                            let pageLink = `
                                <li class="pagination-item ${i ==0 ? 'active' : ''}" data-page="${i+1}">
                                        <a href="javascript:void(0)" class="pagination-item__link">${i+1}</a>
                                </li>
                            `
                            html += pageLink;
                        }
                        html +=
                            `
                        <li class="pagination-item" data-page="next">
                                <a href="javascript:void(0)">
                                    <i class="mdi-b next"></i>
                                </a>
                        </li>
                        `
                        maxPage = response;
                        $('#pagination').html(html);
                        setUpEvents()
                    }
                })
            }

            function onSearchData() {
                let tmp_start_price;
                let tmp_end_price;
                if ($('#is_price').is(':checked')) {
                    tmp_start_price = $('#start_price').val()
                    tmp_end_price = $('#end_price').val()
                    if (!tmp_start_price) {
                        toastr.error('Vui lòng nhập giá bắt đầu');
                        return;
                    }
                    if (+tmp_start_price > +tmp_end_price) {
                        toastr.error('Giá bắt đầu phải nhỏ hơn giá đến');
                        return;
                    }
                    start_price = +tmp_start_price;
                    end_price = +tmp_end_price;
                }
                tutor = $('#giangvien').val();
                name = $('#search').val();
                page = 1
                let searchData = {
                    page: 1,
                    tutor: tutor,
                    name: name,
                }
                if ($('#is_price').is(':checked')) {
                    searchData.start_price = start_price;
                    searchData.end_price = end_price;
                }
                initPagination()
                $.ajax({
                    url: 'http://localhost:62280/courses/ajax_call_action.php?action=get_course_by_page',
                    method: 'POST',
                    data: JSON.stringify(searchData),
                    headers: {
                        'Access-Control-Allow-Origin': '*' // Thiết lập CORS header cho yêu cầu
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        console.log(data)
                        showData(data);
                    }
                })
            }

            function showData(data) {
                $('#courses-section__content').empty()
                html = ``;
                startIndex = 5 * (+data['page'] - 1) + 1
                for (let i = 0; i < data.course.length; i++) {
                    html +=
                        `     
                    <div class="row" style="<? if ($index > 0) echo "margin-top:14rem;" ?>">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="courses-section__content__course-item">
                                            <img src="<? echo ($this->basePath) ?>${data.course[i].posterURI}" class="courses-section__content__course-item-image">
                                            </img>
                                            <div class="courses-section__content__course-item__info d-flex justify-content-between flex-column">
                                                <div style="padding-top: 6rem; padding-bottom:6rem">
                                                    <div class="course-item__info-section pt-2 pb-4">
                                                        <span class="course-item__info-section__author">GV: ${data.course[i].tutorName}</span>
                                                    </div>
                                                    <p class="course-item__info-section__title">${data.course[i].name}</p>
                                                    <div class="d-flex align-items-center justify-content-evenly" style=" flex-wrap: wrap;margin-top: 4rem; margin-bottom:4rem;">
                                                        <div class="d-flex justify-content-between align-items-center b">
                                                            <span class="mini-icon mdi-b calendar">
                                                            </span>
                                                            <span class="course-item__info-section__text">
                                                                ${dayDiff(data.course[i].beginDate,data.course[i].endDate)} Ngày
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center b">
                                                            <span class="mini-icon mdi-b student">
                                                            </span>
                                                            <span class="course-item__info-section__text">
                                                                2 Học viên
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center b">
                                                            <span class="mini-icon mdi-b document">
                                                            </span>
                                                            <span class="course-item__info-section__text">
                                                                ${data.course[i].lessons.length} Bài giảng
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between ps-3" style="padding-bottom: 6rem; padding-right:8rem;">
                                                    <p class="course-item__info-section__price">${data.course[i].price} VND</p>

                                                    <a href="/courses/detail.php?courseId=${data.course[i].id}" class="course-item__info-section__link">Xem chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>     
                    `
                }
                $('#courses-section__content').html(html)
            }
            // dd-MM-yyyy
            function dayDiff(beginDate, endDate) {
                var begindate = new Date(beginDate.date);
                var enddate = new Date(endDate.date);

                // Tính sự chênh lệch giữa hai ngày theo mili giây
                var timeDiff = Math.abs(enddate.getTime() - begindate.getTime());

                // Chuyển đổi từ mili giây sang số ngày
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));


                return daysDiff;
            }
        </script>
<?
    }
}

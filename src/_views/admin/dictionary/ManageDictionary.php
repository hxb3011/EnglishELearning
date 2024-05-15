<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
class ManageDictionaryPage extends BaseHTMLDocumentPage
{
    public Lemma $lemma;
    public $meaning_arr = array();
    public $example_arr = array();
    public $pronunciation_arr = array();
    public $conjugation_arr = array();
    public $words;
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
            "/clients/css/admin/main.css",
            "/clients/css/admin/pagination.css",
            "/node_modules/jquery-ui/dist/themes/base/jquery-ui.min.css"
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
                        Danh sách từ vựng
                    </div>
                </div>
            </div>
            <div style="margin-top:10px; margin-bottom:10px"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="filter-section row">
                                
                                <div class="filter-part d-flex align-items-center justify-content-center col-md-4 col-sm-12   ">
                                    <div class="form-outline" data-mdb-input-init>
                                        <input type="search" id="search_name" class="form-control" placeholder="Tìm từ " />
                                    </div>
                                </div>
                                <div class="filter-part d-flex align-items-center justify-content-center col-md-3 col-sm-12" id="btn_search">
                                    <button class="btn  filter-btn"  onclick="">
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
                                                <th scope="col">Từ</th>
                                                <th scope="col">Loại từ</th>
                                                <th scope="col">Nghĩa</th>
                                                <th scope="col">State</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">
                                            <?  if ($this->words != null) : ?>
                                                <?php
                                                foreach ($this->words as $word) :
                                                ?>
                                                    <tr>
                                                        <th scope="row"><? echo ($word['lemma']['ID'] ) ?></th>
                                                        <td class="text-capitalize"><? echo ($word['lemma']['keyL']) ?></td>
                                                        <td class="text-capitalize"><? echo ($word['lemma']['partOfSpeech']) ?></td>
                                                        <td class="text-capitalize">    
                                                            <? foreach($word['meaning'] as $meaning) echo $meaning; ?>
                                                        </td>
                                                        <td>
                                                            <? //if (isset($word['state']) == 1) : ?>
                                                                <? //if ($word['state'] == 1) :?>
                                                                <span class="badge text-bg-success">Hoạt động</span>
                                                            <?// else : ?>
                                                                <!-- <span class="badge text-bg-danger">Ngưng</span> -->
                                                                <?//endif ?>
                                                            <? // ?>
                                                        </td>
                                                        <td>
                                                            <span class="badge text-bg-secondary"><? // if (isset($word['state']) == 1) echo ($word['contributor']);  ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="dropright">
                                                                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <span class="mdi-b dots-vertical"></span>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="/administration/dictionary/edit.php?lemmaID=<? echo $word['lemma']['ID'] ?>">Chỉnh sửa</a></li>
                                                                    <li><a class="dropdown-item" onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_course&courseId=<? echo ($word['lemma']['ID']); ?>','Xóa khóa học')">Xóa khóa học</a></li>

                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <? endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
        </div>
        <?
        $this->scripts(
            "/node_modules/jquery/dist/jquery.min.js",
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
            "/node_modules/toastr/build/toastr.min.js",
            "/node_modules/sweetalert2/dist/sweetalert2.min.js",
            "/clients/admin/main.js",
            "/clients/admin/autocomplete.js"
        );
        ?>
        <script>
            var maxPage = 0;
            var tutor = '';
            var name = '';
            $(document).ready(function() {
                initPagination();

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

                    if (targetPage != currentPage) {
                        $('.pagination-item.active').removeClass('active');
                        $('.pagination-item').each(function() {
                            if (+$(this).data('page') == targetPage) {
                                $(this).addClass('active')
                            }
                        })
                        $.ajax({
                            url: 'http://localhost:62280/administration/courses/api/ajax_call_action.php?action=get_course_by_page',
                            method: 'POST',
                            data: JSON.stringify({
                                page: targetPage,
                                tutor: tutor,
                                name: name
                            }),
                            ers: {
                                'Access-Control-Allow-Origin': '*' // Thiết lập CORS header cho yêu cầu
                            },
                            success: function(response) {
                                let data = JSON.parse(response);
                                showData(data);
                            }
                        })
                    }

                })
            }

            function initPagination() {
                search = 0;
                $.ajax({
                    url: 'http://localhost:62280/administration/courses/api/ajax_call_action.php?action=get_total_page',
                    method: 'POST',
                    data: JSON.stringify({
                        tutor: tutor,
                        name: name
                    }),
                    headers: {
                        'Access-Control-Allow-Origin': '*' // Thiết lập CORS header cho yêu cầu
                    },
                    success: function(response) {
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
                tutor = $('#giangvien').val();
                name = $('#search_name').val();
                initPagination()
                search = 1;
                $.ajax({
                    url: 'http://localhost:62280/administration/courses/api/ajax_call_action.php?action=get_course_by_page',
                    method: 'POST',
                    data: JSON.stringify({
                        page: 1,
                        tutor: tutor,
                        name: name
                    }),
                    headers: {
                        'Access-Control-Allow-Origin': '*' // Thiết lập CORS header cho yêu cầu
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        showData(data);
                    }
                })
            }

            function showData(data) {
                $('#table_body').empty()
                html = ``;
                startIndex = 5 * (+data['page'] - 1) + 1
                for (let i = 0; i < data.course.length; i++) {
                    let beginDate = reuturnFormatDateString(data.course[i].beginDate.date)
                    let endDate = reuturnFormatDateString(data.course[i].endDate.date)
                    html +=
                        `
                        <tr>
                                <th scope="row">${startIndex+i}</th>
                                    <td>${data.course[i].name}</td>
                                    <td>${data.course[i].tutorName}</td>
                                    <td>
                                        Ngày bắt đầu : ${beginDate}
                                        <br />
                                        Ngày kết thúc : ${endDate}
                                    </td>
                                    <td>
                                        ${ (data.course[i].state==1) ? "<span class=\"badge text-bg-success\">Hoạt động</span>" : "<span class=\"badge text-bg-success\">Hoạt động</span>"}
                                    </td>
                                    <td>
                                            <span class="badge text-bg-secondary">${data.course[i].price} VNĐ</span>
                                    </td>
                                    <td>
                                        <div class="dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <span class="mdi-b dots-vertical"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="/courses/detail.php/${data.course[i].id}" target="_blank">Xem khóa học</a></li>
                                                <li><a class="dropdown-item" href="/administration/courses/edit.php?courseId=${data.course[i].id}">Sửa khóa học</a></li>
                                                <li><a class="dropdown-item" onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_course&courseId=${data.course[i].id}','Xóa khóa học')">Xóa khóa học</a></li>

                                            </ul>
                                        </div>
                                </td>
                        </tr>            
                    `
                }
                $('#table_body').html(html)
            }
            // dd-MM-yyyy
            function reuturnFormatDateString(dateString) {
                var date = new Date(dateString);

                // Lấy ngày, tháng và năm từ đối tượng Date
                var day = ("0" + date.getDate()).slice(-2); // Lấy ngày, thêm "0" và cắt 2 kí tự cuối cùng
                var month = ("0" + (date.getMonth() + 1)).slice(-2); // Lấy tháng, thêm "0" và cắt 2 kí tự cuối cùng
                var year = date.getFullYear(); // Lấy năm

                // Định dạng lại chuỗi ngày tháng năm
                var formattedDate = day + "-" + month + "-" + year;
                return formattedDate;
            }
        </script>
<?
    }
}

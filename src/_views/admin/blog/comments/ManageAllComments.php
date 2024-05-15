<? 
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

Class ManageAllComments extends BaseHTMLDocumentPage{
    public $comments = array();
    public $authors = array();
    public function __construct()
    {
        parent::__construct();
    } 
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
            "/clients/css/admin/pagination.css"
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
                        Danh sách các bình luận
                    </div>
                </div>
                <div class="categories">
                    <div class=""></div>
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
                                        Người đăng
                                    </span>
                                    <select class="form-select" name="nguoi_dang" id="author">
                                        <?foreach($this->authors as $index=>$author):?>
                                                <option value="<?echo $author->getId()?>"><?echo($author->lastName.' '.$author->firstName)?></option>
                                            <?endforeach?>
                                        </select>
                                    </div>
                                <div class="filter-part d-flex align-items-center justify-content-center col-md-3 col-sm-12" id="btn_search">
                                    <div class="form-outline" data-mdb-input-init>
                                        <input type="search" id="search_name" class="form-control" placeholder="Tìm theo tên " />
                                    </div>
                                    <button class="btn  filter-btn" onclick="onSearchData()">
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
                                                <th scope="col">SubID</th>
                                                <th scope="col">Người bình luận</th>
                                                <th scope="col">Nội dụng</th>
                                                <th scope="col">Thời gian đăng</th>
                                                <th scope="col">Trạng thái</th>
                                                <!--<th scope="col">Actions</th>-->
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">
                                        <? if($this->comments != null): ?>
                                                <?php
                                                foreach ($this->comments as $index => $comment) :
                                                ?>
                                                    <tr>
                                                        <th scope="row"><? echo ($index + 1) ?></th>
                                                        <td><? echo ($comment->SubId) ?></td>
                                                        <td><? echo ($comment->AuthID) ?></td>
                                                        <td><? echo ($comment->content) ?></td>
                                                        <td><? echo ($comment->date->format('d-m-Y')); ?></td>
                                                        <td>
                                                            <? if ($comment->status == 1) : ?>
                                                                <span class="badge text-bg-success">Hiện</span>
                                                            <? else : ?>
                                                                <span class="badge text-bg-danger">Ẩn</span>
                                                            <? endif ?>
                                                        </td>
                                                        <td>
                                                            <div class="dropright">
                                                                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <span class="mdi-b dots-vertical"></span>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="/blog/detail.php/<?echo $comment->SubId?>" target="_blank">Xem khóa học</a></li>
                                                                    <li><a class="dropdown-item" href="/administration/blog/edit.php?Id=<?echo $comment->SubId?>">Sửa khóa học</a></li>
                                                                    <li><a class="dropdown-item" onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_course&courseId=<? echo ($comment->id); ?>','Xóa khóa học')">Xóa khóa học</a></li>

                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <? endif?>
                                            <!--
                                            <th scope="row">1</th>
                                            <td>001</td>
                                            <td>Sub1</td>
                                            <td>Bài post 1</td>
                                            <td>Bài này hay vcl</td>
                                            <td>25/01/2000</td>
                                            <td>asdas, sad ,a sd asd </td>
                                            <td>1</td>
                                            <td>
                                                <? //if ($post->state == 1) : ?>
                                                    <span class="badge text-bg-success">Hoạt động</span>
                                                <? //else : ?>
                                                    <span class="badge text-bg-danger">Ngưng</span>
                                                <? //endif ?>
                                            </td>
                                            <td>
                                                <div class="dropright">
                                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="mdi-b dots-vertical"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="/courses/detail.php/<?//echo $post->SubId?>" target="_blank">Xem khóa học</a></li>
                                                        <li><a class="dropdown-item" href="/administration/courses/edit.php?courseId=<?//echo $post->SubId?>">Sửa khóa học</a></li>
                                                        <li><a class="dropdown-item" onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_course&courseId=<? //echo ($post->id); ?>','Xóa khóa học')">Xóa khóa học</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        -->
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
            "/clients/js/admin/main.js"
        );
        ?>
        <script>
            var maxPage = 0;
            var author = '';
            var title = '';
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
                            url: 'http://localhost:62280/administration/courses/api/ajax_call_action.php?action=get_post_by_page',
                            method: 'POST',
                            data: JSON.stringify({
                                page: targetPage,
                                author: author,
                                title: title
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
                        author: author,
                        title: title
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
                tutor = $('#author').val();
                title = $('#search_name').val();
                initPagination()
                search = 1;
                $.ajax({
                    url: 'http://localhost:62280/administration/courses/api/ajax_call_action.php?action=get_post_by_page',
                    method: 'POST',
                    data: JSON.stringify({
                        page: 1,
                        author:author,
                        title: title
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
                for (let i = 0; i < data.post.length; i++) {
                    let post_date = reuturnFormatDateString(data.post[i].date.date)
                    html +=
                        `
                        <tr>
                                <th scope="row">${startIndex+i}</th>
                                    <td>${data.post[i].SubId}</td>
                                    <td>${data.post[i].author}</td>
                                    <td>${data.post[i].title}</td>
                                    <td>${data.post[i].content}</td>
                                    <td>${post_date}</td>
                                    <td><? echo ($comment->tags) ?></td>
                                    <td>
                                        ${ (data.comment[i].status==1) ? "<span class=\"badge text-bg-success\">Hoạt động</span>" : "<span class=\"badge text-bg-success\">Hoạt động</span>"}
                                    </td>
                                    <td>
                                        <div class="dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <span class="mdi-b dots-vertical"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="/courses/detail.php/${data.comment[i].SubId}" target="_blank">Chi tiết</a></li>
                                                <li><a class="dropdown-item" href="/administration/courses/edit.php?courseId=${data.comment[i].SubId}">Sửa </a></li>
                                                <li><a class="dropdown-item" onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_post&subId=${data.comment[i].SubId}','Xóa khóa học')">Xóa</a></li>
                                            </ul>
                                        </div>
                                </td>
                        </tr>            
                    `
                }
                $('#table_body').html(html)
            }
            <th scope="row"><? echo ($index + 1) ?></th>
            <td><? echo ($comment->SubId) ?></td>
            <td><? echo ($comment->AuthID) ?></td>
            <td><? echo ($comment->content) ?></td>
            <td><? echo ($comment->date->format('d-m-Y')); ?></td>
            <td>
                <? if ($comment->status == 1) : ?>
                    <span class="badge text-bg-success">Hoạt động</span>
                <? else : ?>
                    <span class="badge text-bg-danger">Ngưng</span>
                <? endif ?>
            </td>
            <td>
                <div class="dropright">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="mdi-b dots-vertical"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/blog/detail.php/<?echo $comment->SubId?>" target="_blank">Xem khóa học</a></li>
                        <li><a class="dropdown-item" href="/administration/blog/edit.php?Id=<?echo $comment->SubId?>">Sửa khóa học</a></li>
                        <li><a class="dropdown-item" onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_course&courseId=<? echo ($comment->id); ?>','Xóa khóa học')">Xóa khóa học</a></li>
                    </ul>
                </div>
            </td>
            dd-MM-yyyy
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
    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
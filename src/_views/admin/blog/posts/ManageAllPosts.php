<? 
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

Class ManageAllPosts extends BaseHTMLDocumentPage{
    public $posts = array();
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
                        Danh sách  bài post
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
                                    <select class="form-select" name="nguoi_dang" id="tac_gia">
                                        <?foreach($this->authors as $index=>$author):?>
                                                <option value="<?echo $author->getId()?>"><?echo($author->firstName.' '.$author->lastName)?></option>
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
                                    <table class="table posts table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">SubID</th>
                                                <th scope="col">Người đăng</th>
                                                <th scope="col">Tên bài</th>
                                                <th scope="col">Nội dụng</th>
                                                <th scope="col">Thời gian đăng</th>
                                                <th scope="col">Số lượng bình luận</th>
                                                <th scope="col">Tags</th>
                                                <th scope="col">Trạng thái</th>
                                                <!--<th scope="col">Actions</th>-->
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">
                                        <? if($this->posts != null): ?>
                                                <?php
                                                foreach ($this->posts as $index => $post) :
                                                ?>
                                                    <tr>
                                                        <th scope="row"><? echo ($index + 1) ?></th>
                                                        <td><? echo ($post->SubId) ?></td>
                                                        <td><? echo ($post->author) ?></td>
                                                        <td><? echo ($post->title) ?></td>
                                                        <td><? echo ($post->content) ?></td>
                                                        <td><? echo ($post->date->format('d-m-Y')); ?></td>
                                                        <td><? echo ($post->amount_of_comments) ?></td>
                                                        <td><? echo ($post->tags) ?></td>
                                                        <td>
                                                            <? if ($post->status == 1) : ?>
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
                                                                    <li><a class="dropdown-item" href="http://localhost:62280/blog/detail.php?SubId=/<?echo $post->SubId?>" target="_blank">Xem bài post</a></li>
                                                                    <li><a class="dropdown-item" href="/administration/blog/edit.php?Id=<?echo $post->SubId?>">Sửa post</a></li>
                                                                    <li><a class="dropdown-item" onclick="confirm_delete_modal('http://localhost:62280/administration/blog/api/ajax_call_action.php?action=delete_post&ProfileId=<?echo ($post->ProfileId)?>&SubId=<? echo ($post->SubId); ?>','Xóa')">Xóa</a></li>

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
                            url: 'http://localhost:62280/administration/blog/api/ajax_call_action.php?action=get_post_by_page',
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
                    url: 'http://localhost:62280/administration/blog/api/ajax_call_action.php?action=get_total_page',
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
                author = $('#tac_gia').val();
                title = $('#search_name').val();
                initPagination()
                search = 1;
                $.ajax({
                    url: 'http://localhost:62280/administration/blog/api/ajax_call_action.php?action=get_posts_by_page',
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
                                    <td>${data.post[i].amount_of_comments}</td>
                                    <td><? echo ($post->tags) ?></td>
                                    <td>
                                        ${ (data.post[i].status==1) ? "<span class=\"badge text-bg-success\">Hiện</span>" : "<span class=\"badge text-bg-success\">Ẩn</span>"}
                                    </td>
                                    <td>
                                        <div class="dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <span class="mdi-b dots-vertical"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="/courses/detail.php/${data.post[i].SubId}" target="_blank">Xem bài post</a></li>
                                                <li><a class="dropdown-item" href="/administration/courses/edit.php?courseId=${data.post[i].SubId}">Sửa post</a></li>
                                                <li><a class="dropdown-item" onclick="confirm_delete_modal('http://localhost:62280/administration/blog/api/ajax_call_action.php?action=delete_post&ProfileId=${data.post[i].ProfileId}&SubId=${data.post[i].SubId}','Xóa')">Xóa</a></li>
                                            </ul>
                                        </div>
                                </td>
                        </tr>            
                    `
                }
                $('#table_body').html(html)
            }
            <th scope="row"><? echo ($index + 1) ?></th>
            <td><? echo ($post->SubId) ?></td>
            <td><? echo ($post->author) ?></td>
            <td><? echo ($post->title) ?></td>
            <td><? echo ($post->content) ?></td>
            <td><? echo ($post->date->format('d-m-Y')); ?></td>
            <td><? echo ($post->amount_of_comments) ?></td>
            <td><? echo ($post->tags) ?></td>
            <td>
                <? if ($post->status == 1) : ?>
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
                        <li><a class="dropdown-item" href="/blog/detail.php/<?echo $post->SubId?>" target="_blank">Xem bài post</a></li>
                        <li><a class="dropdown-item" href="/administration/blog/edit.php?Id=<?echo $post->SubId?>">Sửa post</a></li>
                        <li><a class="dropdown-item" onclick="confirm_delete_modal('http://localhost:62280/administration/blog/api/ajax_call_action.php?action=delete_post&ProfileId=${data.post[i].ProfileId}&SubId=${data.post[i].SubId}','Xóa khóa học')">Xóa</a></li>
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
<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("profile/profile.php");
class ProfileMainPage extends BaseHTMLDocumentPage
{
    private IPermissionHolder $holder;
    private array $profiles;
    public function __construct(IPermissionHolder $holder, array $profiles)
    {
        parent::__construct();
        $this->holder = $holder;
        $this->profiles = $profiles;
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
        $profile_create = false;
        $profile_read = false;
        $profile_update = false;
        $profile_delete = false;
        $holder = $this->holder;
        if (isset($holder)) {
            $key = $holder->getKey();
            $profile_create = $key->isPermissionGranted(Permission_ProfileCreate);
            $profile_read = $key->isPermissionGranted(Permission_ProfileRead);
            $profile_update = $key->isPermissionGranted(Permission_ProfileUpdate);
            $profile_delete = $key->isPermissionGranted(Permission_ProfileDelete);
        }
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="admin-header">
                        <span class="mdi-b apple-keyboard-command admin-header__icon"></span>
                        Danh sách hồ sơ
                    </div>
                </div>
            </div>
            <div style="margin-top:10px; margin-bottom:10px"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="filter-section row justify-content-between">
                                <div class="filter-part d-flex align-items-center justify-content-center col-md-4 col-sm-12 m-1">
                                    <div class="form-outline" data-mdb-input-init>
                                        <input type="search" id="search_name" class="form-control" placeholder="Tìm theo tên " />
                                    </div>
                                </div>
                                <div class="filter-part d-flex align-items-center justify-content-center col-md-3 col-sm-12 m-1" id="btn_search">
                                    <button class="btn filter-btn" onclick="onSearchData()"> Lọc </button>
                                </div>
                                <div class="filter-part d-flex align-items-center justify-content-center col-md-3 col-sm-12 m-1" id="btn_add">
                                    <a type="button" href="/administration/profile/edit.php?add=1" class="btn btn-outline-primary btn-rounded btn-icon"><i class="mdi-b -plus"></i>Thêm</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Họ và tên</th>
                                                <th scope="col">Giới tính</th>
                                                <th scope="col">Ngày sinh</th>
                                                <th scope="col">Loại hồ sơ</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">
                                            <?
                                            $profiles = $this->profiles;
                                            if (isset($profiles)) {
                                                global $fragment_profiles;
                                                global $fragment_profile_read;
                                                global $fragment_profile_update;
                                                global $fragment_profile_delete;
                                                
                                                $fragment_profiles = $profiles;
                                                $fragment_profile_read = $profile_read;
                                                $fragment_profile_update = $profile_update;
                                                $fragment_profile_delete = $profile_delete;
                                                requirv("admin/profile/ProfileItemFragment.php");
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="pagination" id="pagination"></ul>
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
            "/clients/admin/main.js"
        );
        ?>
        <script>
            $(document).ready(function() {
                initPagination({ page: 1 });
            })

            function initPagination(data) {
                $.ajax({
                    url: '/administration/profile/getTotalPage.php',
                    method: 'POST',
                    data: JSON.stringify(data),
                    headers: {
                        'Access-Control-Allow-Origin': '*' // Thiết lập CORS header cho yêu cầu
                    },
                    success: function(response) {
                        $('#pagination').html(response);
                        $('.pagination-item').click(function() {
                            let targetPage = $(this).data('page');
                            let currentPage = $('.pagination-item.active').data('page')

                            if (targetPage != currentPage) {
                                data.page = targetPage;
                                initPagination(data);
                                loadItems(data);
                            }
                        });
                    }
                })
            }

            function onSearchData() {
                let name = $('#search_name').val();
                let data = {
                    page: 1,
                    name
                };
                initPagination(data);
                loadItems(data);
            }

            function loadItems(data) {
                $.ajax({
                    url: '/administration/profile/getProfileByPage.php',
                    method: 'POST',
                    data: JSON.stringify(data),
                    headers: {
                        'Access-Control-Allow-Origin': '*' // Thiết lập CORS header cho yêu cầu
                    },
                    success: function(response) {
                        $('#table_body').empty();
                        $('#table_body').html(response);
                    }
                });
            }
        </script>
        <?
    }
}

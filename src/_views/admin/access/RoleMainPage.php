<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("access/permission.php");
class RoleMainPage extends BaseHTMLDocumentPage
{
    private IPermissionHolder $holder;
    private array $roles;
    private Role $instructorRole;
    private Role $learnerRole;
    public function __construct(IPermissionHolder $holder, array $roles, Role $instructorRole, Role $learnerRole)
    {
        parent::__construct();
        $this->holder = $holder;
        $this->roles = $roles;
        $this->instructorRole = $instructorRole;
        $this->learnerRole = $learnerRole;
    }
    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Vai trò - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Vai trò - " . $title);
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
        $role_create = false;
        $role_read = false;
        $role_update = false;
        $role_delete = false;
        $holder = $this->holder;
        if (isset($holder)) {
            $key = $holder->getKey();
            $role_create = $key->isPermissionGranted(Permission_RoleCreate);
            $role_read = $key->isPermissionGranted(Permission_RoleRead);
            $role_update = $key->isPermissionGranted(Permission_RoleUpdate);
            $role_delete = $key->isPermissionGranted(Permission_RoleDelete);
        }
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="admin-header">
                        <span class="mdi-b apple-keyboard-command admin-header__icon"></span>
                        Danh sách vai trò
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
                                    <a type="button" href="/administration/access/editRole.php?add=1" class="btn btn-outline-primary btn-rounded btn-icon"><i class="mdi-b -plus"></i>Thêm</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">
                                            <?
                                            $roles = $this->roles;
                                            if (isset($roles)) {
                                                global $fragment_roles;
                                                global $fragment_role_read;
                                                global $fragment_role_update;
                                                global $fragment_role_delete;
                                                
                                                $fragment_roles = $roles;
                                                $fragment_role_read = $role_read;
                                                $fragment_role_update = $role_update;
                                                $fragment_role_delete = $role_delete;
                                                requirv("admin/access/RoleItemFragment.php");
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
                    url: '/administration/access/getTotalRolePage.php',
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
                    url: '/administration/access/getRoleByPage.php',
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

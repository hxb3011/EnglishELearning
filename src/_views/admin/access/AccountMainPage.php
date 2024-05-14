<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("access/permission.php");
class AccountMainPage extends BaseHTMLDocumentPage
{
    private IPermissionHolder $holder;
    private array $accounts;
    public function __construct(IPermissionHolder $holder, array $accounts)
    {
        parent::__construct();
        $this->holder = $holder;
        $this->accounts = $accounts;
    }
    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Tài khoản - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Tài khoản - " . $title);
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
        $account_create = false;
        $account_read = false;
        $account_update = false;
        $account_delete = false;
        $holder = $this->holder;
        if (isset($holder)) {
            $key = $holder->getKey();
            $account_create = $key->isPermissionGranted(Permission_AccountCreate);
            $account_read = $key->isPermissionGranted(Permission_AccountRead);
            $account_update = $key->isPermissionGranted(Permission_AccountUpdate);
            $account_delete = $key->isPermissionGranted(Permission_AccountDelete);
        }
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="admin-header">
                        <span class="mdi-b apple-keyboard-command admin-header__icon"></span>
                        Danh sách tài khoản
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
                                        <input type="search" id="search_name" class="form-control" placeholder="Tìm theo tên " />
                                    </div>
                                </div>
                                <div class="filter-part d-flex align-items-center justify-content-center col-md-3 col-sm-12" id="btn_search">
                                    <button class="btn filter-btn" onclick="onSearchData()">
                                        Lọc
                                    </button>
                                </div>
                                <div class="filter-part d-flex align-items-center justify-content-center col-md-3 col-sm-12" id="btn_search">
                                    <a type="button" href="/administration/access/editAccount.php?add=1" class="btn btn-outline-primary btn-rounded btn-icon">
                                        <i class="mdi-b back"></i> Thêm
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên người dùng</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">
                                            <?
                                            $accounts = $this->accounts;
                                            if (isset($accounts)) {
                                                global $fragment_accounts;
                                                global $fragment_account_read;
                                                global $fragment_account_update;
                                                global $fragment_account_delete;
                                                
                                                $fragment_accounts = $accounts;
                                                $fragment_account_read = $account_read;
                                                $fragment_account_update = $account_update;
                                                $fragment_account_delete = $account_delete;
                                                requirv("admin/access/AccountItemFragment.php");
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
                    url: '/administration/access/getTotalAccountPage.php',
                    method: 'POST',
                    data: JSON.stringify(),
                    headers: {
                        'Access-Control-Allow-Origin': '*' // Thiết lập CORS header cho yêu cầu
                    },
                    success: function(response) {
                        $('#pagination').html(response);
                        $('.pagination-item').click(function() {
                            let targetPage = $(this).data('page');
                            let currentPage = +$('.pagination-item.active').data('page')

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
                    url: '/administration/access/getAccountByPage.php',
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

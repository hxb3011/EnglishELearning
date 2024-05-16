<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

class CheckoutHistoryPage extends BaseHTMLDocumentPage
{
    public function __construct()
    {
        parent::__construct();
    }
    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Quản lý - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Quản lý - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon("/assets/images/logo-icon.png", $svg);
    }
    public function head()
    {
        $this->styles(
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/node_modules/datatables/media/css/jquery.dataTables.min.css",
            "/clients/css/admin/main.css",
            "/clients/css/admin/history.css"
        );
    }
    public function body()
    {
?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="admin-header">
                        <i class="mdi-b apple-keyboard-command admin-header__icon"></i>
                        Lịch sử đăng ký khóa học
                    </div>
                </div>
            </div>
            <div style="margin-top:10px; margin-bottom:10px"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="filter-date d-flex justify-content-between">
                                        <div class="d-flex justify-content-start mb-3 text-dark">
                                            <div class="mx-1">
                                                <label for="start-date">Từ</label>
                                                <input type="date" id="start-date">
                                            </div>
                                            <div class="mx-1">
                                                <label for="end-date">Đến</label>
                                                <input type="date" id="end-date">
                                            </div>
                                        </div>
                                        <button onClick="window.location.reload();" class="btn btn-primary">Làm mới</button>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="history">
                                        <thead>
                                            <tr>
                                                <th>Mã</th>
                                                <th>Họ học viên</th>
                                                <th>Tên học viên</th>
                                                <th>Khóa học</th>
                                                <th>Ngày đăng kí</th>
                                                <th>Giá</th>
                                            </tr>
                                        </thead>

                                    </table>
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
            "/node_modules/datatables/media/js/jquery.dataTables.min.js",
            "https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js",
            "/clients/admin/main.js",
        );
        ?>
        <script>
            let dataT;
            $(document).ready(function() {
                dataT = $('#history').DataTable({
                    "ajax": {
                        url: "/administration/history/ajax_call_action.php?action=get_all"
                    },
                    "language": {
                        "sProcessing": "Đang xử lý...",
                        "sLengthMenu": "Hiển thị _MENU_ dòng",
                        "sZeroRecords": "Không tìm thấy dữ liệu",
                        "sInfo": "Hiển thị từ _START_ đến _END_ của _TOTAL_ dòng",
                        "sInfoEmpty": "Hiển thị từ 0 đến 0 của 0 dòng",
                        "sInfoFiltered": "(được lọc từ _MAX_ dòng)",
                        "sInfoPostFix": "",
                        "sSearch": "Tìm kiếm:",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "Đầu",
                            "sPrevious": "Trước",
                            "sNext": "Tiếp",
                            "sLast": "Cuối"
                        }
                    },
                    "columns": [{
                            data: 'ID',
                            width: "10%"
                        },
                        {
                            data: 'FirstName',
                            with: "15%"
                        },
                        {
                            data: 'LastName',
                            with: "15%"
                        },

                        {
                            data: 'Name',
                            width: "30%"
                        },
                        {
                            data: 'AtDateTime',
                            width: "20%"
                        },
                        {
                            data: 'Price',
                            width: "10%"
                        },

                    ],
                });
                // $.ajax({
                //     url: '/administration/history/ajax_call_action.php?action=get_all',
                //     type: 'get',
                //     success: function(data) {
                //         let re = JSON.parse(data)
                //         console.log(re);
                //     }
                // });
            });
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    let min = $('#start-date').val();
                    let max = $('#end-date').val();
                    let createdAt = data[4] || 0; // Our date column in the table
                    if ((min == "" || max == "") ||
                        (moment(createdAt).isSameOrAfter(min) &&
                            moment(createdAt).isSameOrBefore(max))
                    ) {
                        return true;
                    }
                    return false;
                }
            );

            $("#start-date").change(function() {
                dataT.draw();
            });
            $("#end-date").change(function() {
                dataT.draw();
            });
        </script>

<?
    }
}

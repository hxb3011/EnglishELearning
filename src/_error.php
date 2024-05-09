<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class ErrorPage extends BaseHTMLDocumentPage
{
    private $ersp;
    private $title;
    private $desc;
    public function __construct(int $activeNav)
    {
        parent::__construct($activeNav);
        $ersp = &$_GET["ersp"];
        $uri = &$_GET["uri"];
        if (!isset($uri))
            $uri = "(không rõ đường dẫn)";
        elseif (strpos($uri, "/_controllers/") !== false)
            $uri = substr($uri, 13);

        $this->ersp = $ersp;
        $title = "Chưa định nghĩa";
        $desc = "Chưa định nghĩa";
        switch ($ersp) {
            case '403':
                $title = "Trang bị chặn";
                $desc = "Trang \"" . $uri . "\" mà bạn yêu cầu không đủ quyền hạn để truy cập. Vui lòng kiểm tra lại đường đẫn hoặc liên hệ quản trị viên để biết thêm chi tiết.";
                break;
            case '404':
                $title = "Không tìm thấy trang";
                $desc = "Trang \"" . $uri . "\" mà bạn yêu cầu không tìm thấy. Vui lòng kiểm tra lại đường đẫn.";
                break;
            case '500':
                $title = "Lỗi máy chủ";
                $desc = "Máy chủ đang xảy ra sự cố. Vui lòng liên hệ quản trị viên để biết thêm chi tiết.";
                break;
            default:
                break;
        }
        $this->title = $title;
        $this->desc = $desc;
    }

    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, $this->title . " - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, $this->title . " - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "/clients/css/errorPage.css"
        );
        // $this->scripts(

        // );
    }

    public function body()
    {
        ?>
        <div class="error -content">
            <img src="/clients/images/favicon.svg" alt="biểu tượng ứng dụng">
            <h1><?= $this->ersp ?></h1>
            <h3><?= $this->title ?></h3>
            <p><?= $this->desc ?></p>
        </div>
        <?
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}

global $page;
global $activeNavGetError;
if (!isset($activeNavGetError)) $activeNavGetError = NAV_COURSE_INTRO;
$page = new ErrorPage($activeNavGetError);
requira("_layout.php");
?>
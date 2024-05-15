<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class CourseSinglePage extends BaseHTMLDocumentPage
{
    public Course $course;
    public array $programs = array();
    public string $basePath;
    public int $totalLesson;
    public int $totalExcercise;
    public bool $isRegistered;
    public bool $isRegisterable;
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
        parent::documentInfo($author, $description, "Tên khóa học - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Tên khóa học - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon("/assets/images/logo-icon.png", $svg);
    }

    public function head()
    {
        $this->styles(
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/clients/css/pagination.css",
            "/clients/css/courses/course-single.css",
        );
        $this->scripts(
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
        );
    }

    public function body()
    {
?>
        <div class="wrapper">
        </div>
<?
        $this->scripts(
            "/node_modules/jquery/dist/jquery.min.js",
        );
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>
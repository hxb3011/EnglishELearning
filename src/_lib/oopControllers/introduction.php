<?
require_once "/var/www/html/_lib/utils/requir.php";

class Introduction
{
    public function __construct()
    {
    }
    public function index()
    {
        requirv("introduction/home.old.php");
        global $page;
        $page = new CoursesIntroductionHomePage();
        requira("_layout.php");
    }
    public function contact()
    {
        requirv("introduction/contact.php");
        global $page;
        $page = new ContactPage();
        requira("_layout.php");
    }
    public function faqs()
    {
        requirv("introduction/faqs.php");
        global $page;
        $page = new FAQsPage();
        requira("_layout.php");
    }
    public function blog()
    {
        requirv("blog/bloglist.php");
        global $page;
        $page = new BlogListPage();
        requira("_layout.php");
    }
}
?>
<?
require_once "/var/www/html/_lib/utils/requir.php"; 
class AdminCourses{
    public function __construct()
    {
        
    }
    public function index(){
        requirv("admin/courses/ManageAllCoursePage.php");
        global $page;
        $page = new ManageAllCoursePage();
        requira("_adminLayout.php");
    }
    public function add(){
        requirv("admin/courses/AddNewCoursePage.php");
        global $page;
        $page = new AddNewCoursePage();
        requira("_adminLayout.php");
    }
}
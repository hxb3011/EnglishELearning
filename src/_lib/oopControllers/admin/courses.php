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
    public function edit($courseID = 1)
    {
        requirv("admin/courses/EditCoursePage.php");
        global $page;
        $page = new EditCoursePage();
        requira("_adminLayout.php");
    }
    /* Modal */
    public function add_video_modal()
    {
        requirv("admin/courses/modal/add_video.php");
    }
}
<?
require_once "/var/www/html/_lib/utils/requir.php"; 
class Courses {
    public function __construct()
    {
        
    }
    public function all()
    {
        requirv("courses/all-courses.php");
        global $page;
        $page = new AllCoursesPage();
        requira("_layout.php");
    }
    public function detail()
    {
        requirv("courses/course-single.php");
        global $page;
        $page = new CourseSinglePage();
        requira("_layout.php");
    }
    public function learn($courseID)
    {
        requirv("courses/learn.php");
        global $page;
        $page = new LearnPage();
        requira("_layout.php");
    }
}
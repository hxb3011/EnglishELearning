<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/CourseModel.php');
requirm('/access/Course.php');
class AdminCourses
{

    public CourseModel $courseModel;
    public function __construct()
    {
        $this->courseModel = new CourseModel();
    }
    public function index()
    {
        requirv("admin/courses/ManageAllCoursePage.php");
        global $page;
        //$this->courseModel->seedDumbData();
        $page = new ManageAllCoursePage();
        $page->courses = $this->courseModel->getAllCourse();
        requira("_adminLayout.php");
    }
    public function add()
    {
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
    public function add_lesson_modal()
    {
        requirv("admin/courses/modal/add_lesson.php");
    }
    public function add_document_modal()
    {
        requirv("admin/courses/modal/add_document.php");
    }
    public function sort_lesson_modal()
    {
        requirv("admin/courses/modal/sort_lesson.php");
    }
    public function add_exercise_modal()
    {
        requirv("admin/courses/modal/add_excercise.php");
    }
    public function sort_document_modal()
    {
        requirv("admin/courses/modal/sort_document.php");
    }
    public function sort_excercise_modal()
    {
        requirv("admin/courses/modal/sort_excercise.php");
    }
    public function add_question_modal()
    {
        requirv("admin/courses/modal/add_question.php");
    }
}

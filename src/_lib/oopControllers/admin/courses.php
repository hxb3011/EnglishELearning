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
    /* trả về view  */
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
    /* xử lí thêm,sửa,xóa từ các form */
    public function add_course()
    {

        try{
            $course = new Course();
            $course->id = $this->courseModel->generateValidCourseID();
            $course->name = $_POST['title'];
            $course->description = $_POST['description'];
            $course->state = 1;
            $course->profileID = $_POST['tutor'];
            $course->price = floatval($_POST['price']);
            $course->beginDate  = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['start_date']);
            $course->endDate  = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['end_date']);
    
            // lưu file vào folder upload của dự án 
            
            $course->posterURI = $this->saveImageToFolder($course->id);
            $result = $this->courseModel->addCourse($course);
            if ($result >= 1)
            {
                header('Location: /administration/courses/index.php');
            }
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
        
    }
    private function saveImageToFolder($courseID)
    {
        $targetDir= "/var/www/html/uploads/";
        // tạo thư mục uploads nếu không tồn tại
        if(!file_exists($targetDir))
        {
            mkdir($targetDir,0777,true);
        }
        
        //tạo thư mục cho khóa học trong thư mục upload
        $targetDir = $targetDir.$courseID.'/poster'.'/';
        if(!file_exists($targetDir))
        {
            mkdir($targetDir,0777,true);
        }

        $targetFile = $targetDir. basename($_FILES['course_poster']["name"]);   
        // tạo đường dẫn mới cho file ảnh
        if (move_uploaded_file($_FILES['course_poster']["tmp_name"],$targetFile))
        {
            $targetFile = str_replace($targetFile,"","/var/www/html/");
            return $targetFile;
        }
        return "";
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

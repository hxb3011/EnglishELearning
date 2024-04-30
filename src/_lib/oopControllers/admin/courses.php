<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/CourseModel.php');
requirm('/dao/LessonModel.php');
requirm('/dao/ExcerciseModel.php');

requirm('/access/Course.php');
requirm('/access/Lesson.php');
requirm('/access/Excercise.php');


class AdminCourses
{

    public CourseModel $courseModel;
    public LessonModel $lessonModel;
    public ExcerciseModel $excerciseModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->lessonModel = new LessonModel();
        $this->excerciseModel  = new ExcerciseModel();
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
    public function edit($courseId)
    {
        requirv("admin/courses/EditCoursePage.php");
        global $page;
        $page = new EditCoursePage();
        $page->course = $this->courseModel->getCourseById($courseId);
        $lessons = $this->lessonModel->getLessonsByCourseId($courseId);
        $excercises = $this->excerciseModel->getExcercisesByCourseId($courseId);
        $page->programs = array_merge($lessons,$excercises);
        usort($page->programs,array('AdminCourses','compareOrderN'));
        requira("_adminLayout.php");
    }
    /* xử lí thêm,sửa,xóa từ các form */
    public function add_course()
    {

        try {
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
            if ($result >= 1) {
                header('Location: /administration/courses/index.php');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function edit_course()
    {

        try {
            $course = new Course();
            $course->id = $_POST['courseID'];
            $course->name = $_POST['title'];
            $course->description = $_POST['description'];
            $course->state = 1;
            $course->profileID = $_POST['tutor'];
            $course->price = floatval($_POST['price']);
            $course->beginDate  = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['start_date']);
            $course->endDate  = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['end_date']);
            // lưu file vào folder upload của dự án 
            if(isset($_FILES['course_poster']["name"]))
            {
                $course->posterURI = $this->saveImageToFolder($course->id);
            }
            $result = $this->courseModel->updateCourse($course);
            if ($result >= 1) {

                header('Location: /administration/courses/index.php');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    private function saveImageToFolder($courseID)
    {
        $targetDir = "/var/www/html/uploads/";
        // tạo thư mục uploads nếu không tồn tại
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        //tạo thư mục cho khóa học trong thư mục upload
        $targetDir = $targetDir . $courseID . '/poster' . '/';
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($_FILES['course_poster']["name"]);
        // tạo đường dẫn mới cho file ảnh
        if (move_uploaded_file($_FILES['course_poster']["tmp_name"], $targetFile)) {
            $relativePath = str_replace( "/var/www/html/", "", $targetFile);
            return $relativePath;
        }
        return "";
    }
    /* Ajax call */
    public function delete_lesson()
    {
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['courseId']) && isset($_REQUEST['lessonId'])) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
            $jsonData = json_encode($response);
            echo $jsonData;
        } else {

            $response['status'] = '404';
            $response['message'] = 'Không truyền thông tin của khóa học hoặc bài học cần xóa';

            $jsonData = json_encode($response);
            echo $jsonData;
        }
    }
    public function delete_excercise()
    {
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['courseId']) && isset($_REQUEST['excerciseId'])) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
            $jsonData = json_encode($response);
            echo $jsonData;
        } else {

            $response['status'] = '404';
            $response['message'] = 'Không truyền thông tin của khóa học hoặc bài học cần xóa';

            $jsonData = json_encode($response);
            echo $jsonData;
        }
    }
    public function add_lesson(){
        try{
            $lesson = new Lesson();
            $lesson->ID = $this->lessonModel->generateValidLessonID();
            $lesson->Description = $_POST['lesson_desc'];
            $lesson->State = $_POST['lesson_state'];
            $lesson->CourseID = $_POST['course_id'];
            $totalLesson = $this->lessonModel->getTotalLessonInCourse($lesson->CourseID);
            $totalExcercise = $this->excerciseModel->getTotalExcerciseInCourse($lesson->CourseID);
            $lesson->OrderN =  $totalLesson+$totalExcercise+1;
            $result = $this->lessonModel->addLesson($lesson);
            if ($result >= 1) {
                $redirect = "Location: /administration/courses/edit.php?courseId=".$lesson->CourseID;
                header($redirect);
                exit;
            }
        }catch(Exception $ex)
        {

        }
    }
    public function update_lesson(){
        try{
            $lesson = new Lesson();
            $lesson->ID = $_POST['lesson_id'];
            $lesson->Description = $_POST['lesson_desc'];
            $lesson->State = $_POST['lesson_state'];
            $lesson->CourseID = $_POST['course_id'];
            $result = $this->lessonModel->updateLesson($lesson);
            if ($result >= 1) {
                $redirect = "Location: /administration/courses/edit.php?courseId=".$lesson->CourseID;
                header($redirect);
                exit;
            }
        }catch(Exception $ex)
        {

        }
    }
    public function delete_question()
    {

        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['courseId']) && isset($_REQUEST['questionId'])) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
            $jsonData = json_encode($response);
            echo $jsonData;
        } else {

            $response['status'] = '404';
            $response['message'] = 'Không truyền thông tin câu hỏi cần xóa';

            $jsonData = json_encode($response);
            echo $jsonData;
        }
    }
    /* Modal */
    public function lesson_modal()
    {
        global $editMode; 
        global $course;
        global $lesson;
        $editMode = isset($_REQUEST['editmode']);
        // thêm bài giảng
        if(!$editMode)
        {
            if(isset($_REQUEST['courseId'])){
                $course = $this->courseModel->getCourseById($_REQUEST['courseId']);
                requirv("admin/courses/modal/lesson.php");
                
            } else{
                header('Location: /error');
            }
        }else{
        // Sửa bài giảng
            if(isset($_REQUEST['lessonId'])){
                $lesson = $this->lessonModel->getLessonById($_REQUEST['lessonId']);
                $course = $this->courseModel->getCourseById($lesson->CourseID);
                requirv("admin/courses/modal/lesson.php");
                
            } else{
                header('Location: /error');
            }
        }
 
    }
    public function document_modal()
    {
        requirv("admin/courses/modal/document.php");
    }
    public function sort_lesson_modal()
    {
        if(isset($_REQUEST['courseId'])){
            if($_SERVER['REQUEST_METHOD'] == 'GET')
                requirv("admin/courses/modal/sort_lesson.php");
        } elseif (isset($_REQUEST['lessonId'])) {
            requirv("admin/courses/modal/sort_lesson.php");;
        }else{
            header('Location: /error');
        }
    }
    public function excercise_modal()
    {   
        if( isset($_REQUEST['courseId'])){
            if($_SERVER['REQUEST_METHOD'] == 'GET')
             requirv("admin/courses/modal/excercise.php");
        }else{
            header('Location: /error');
        }
    }
    public function sort_document_modal()
    {
        requirv("admin/courses/modal/sort_document.php");
    }
    public function sort_excercise_modal()
    {
        requirv("admin/courses/modal/sort_excercise.php");
    }
    public function question_modal()
    {
        requirv("admin/courses/modal/question.php");
    }
    private static function compareOrderN($a,$b)
    {
        return $a->OrderN - $b->OrderN;
    }
}

<?
require_once "/var/www/html/_lib/utils/requir.php"; 
requirm('/dao/CourseModel.php');
requirm('/dao/LessonModel.php');
requirm('/dao/DocumentModel.php');
requirm('/dao/ExcerciseModel.php');


requirm('/access/Course.php');
requirm('/access/Lesson.php');
requirm('/access/Document.php');
requirm('/access/Excercise.php');

requirl('/services/S3Service.php');
class Courses {
    public CourseModel $courseModel;
    public LessonModel $lessonModel;
    public DocumentModel $documentModel;
    public ExcerciseModel $excerciseModel;
    public S3Service $s3Service;

    
    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->lessonModel = new LessonModel();
        $this->documentModel = new DocumentModel();
        $this->excerciseModel = new ExcerciseModel();

        $this->s3Service =  new S3Service();
    }
    public function all()
    {
        requirv("courses/all-courses.php");
        global $page;
        $page = new AllCoursesPage();
        $page->courses = array_slice($this->courseModel->getAllCourseBySearch(),0,5);
        $page->basePath = $this->s3Service->getBasePath();
        if($page->courses != null)
        {
            foreach($page->courses as $key=>$course)
            {
                $course->lessons = $this->lessonModel->getLessonsByCourseId($course->id);
            }
        }
        //$page->tutors
        requira("_layout.php");
    }
    public function detail($courseId)
    {
        requirv("courses/course-single.php");
        global $page;
        $page = new CourseSinglePage();
        $page->course = $this->courseModel->getCourseById($courseId);
        $lessons = $this->lessonModel->getLessonsByCourseId($courseId);
        $page->totalLesson = count($lessons);
        foreach ($lessons as $lesson) {
            $lesson->Documents = $this->documentModel->getDocumentsByLessonID($lesson->ID);
            usort($lesson->Documents, array('Courses', 'compareOrderN'));
        }
        
        $excercises = $this->excerciseModel->getExcercisesByCourseId($courseId);
        $page->totalExcercise = count($excercises);
        $page->programs = array_merge($lessons, $excercises);
        usort($page->programs, array('Courses', 'compareOrderN'));
        $page->course->posterURI = $this->s3Service->encodeKey($page->course->posterURI);

        requira("_layout.php");
    }
    public function learn($courseID)
    {
        requirv("courses/learn.php");
        global $page;
        $page = new LearnPage();
        requira("_layout.php");
    }

    public function get_total_page()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $courses = $this->courseModel->getAllCourseBySearch($data['name'],$data['tutor']);
        $totalCourses = count($courses);
        $totalPages= $totalCourses / 5;

        echo json_encode(ceil($totalPages));
    }
    public function get_course_by_page()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $response = array();

        $response['page'] = $data['page'];
        $courses = $this->courseModel->getCourseFromPage(intval($data['page']),5,$data['name'],$data['tutor']);
        if($courses != null)
        {
            foreach($courses as $key => $course){
                $course->lessons = $this->lessonModel->getLessonsByCourseId($course->id);
            }
        }
        $response['course'] = $courses;
        echo json_encode($response);
    }
    private static function compareOrderN($a, $b)
    {
        return $a->OrderN - $b->OrderN;
    }
}
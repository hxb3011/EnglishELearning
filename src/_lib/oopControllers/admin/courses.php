<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/CourseModel.php');
requirm('/dao/LessonModel.php');
requirm('/dao/ExcerciseModel.php');
requirm('/dao/DocumentModel.php');
requirm('/dao/QuestionModel.php');

requirm('/access/Course.php');
requirm('/access/Lesson.php');
requirm('/access/Excercise.php');
requirm('/access/Document.php');
requirm('/access/Question.php');


requirl('/services/S3Service.php');

class AdminCourses
{

    public CourseModel $courseModel;
    public LessonModel $lessonModel;
    public ExcerciseModel $excerciseModel;
    public DocumentModel $documentModel;
    public QuestionModel $questionModel;
    public S3Service $s3Service;
    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->lessonModel = new LessonModel();
        $this->excerciseModel  = new ExcerciseModel();
        $this->documentModel = new DocumentModel();
        $this->questionModel = new QuestionModel();
        $this->s3Service =  new S3Service();
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
        foreach ($lessons as $lesson) {
            $lesson->Documents = $this->documentModel->getDocumentsByLessonID($lesson->ID);
            usort($lesson->Documents, array('AdminCourses', 'compareOrderN'));
        }
        $excercises = $this->excerciseModel->getExcercisesByCourseId($courseId);
        $page->programs = array_merge($lessons, $excercises);
        $page->basePath = $this->s3Service->getBasePath();
        usort($page->programs, array('AdminCourses', 'compareOrderN'));
        $page->course->posterURI = $this->s3Service->encodeKey($page->course->posterURI);
        requira("_adminLayout.php");
    }
    /* xử lí thêm,sửa,xóa từ các form , lời gọi từ ajax*/
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

            $course = $this->courseModel->getCourseById($_POST['courseID']);
            $course->name = $_POST['title'];
            $course->description = $_POST['description'];
            $course->state = 1;
            $course->profileID = $_POST['tutor'];
            $course->price = floatval($_POST['price']);
            $course->beginDate  = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['start_date']);
            $course->endDate  = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['end_date']);
            // lưu file vào folder upload của dự án 
            if (strlen($_FILES['course_poster']["name"]) > 0) {
                $this->removeFile($course->posterURI);
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
    public function delete_course()
    {
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['courseId'])) {
            $deletePoster = $this->s3Service->deleteFileInFolder('public/poster/' . $_REQUEST['courseId'] . '/');
            $deleteTextFile = $this->s3Service->deleteFileInFolder('private/text/' . $_REQUEST['courseId'] . '/');
            $delete = $this->s3Service->deleteFileInFolder('private/video/' . $_REQUEST['courseId'] . '/');

            $result = $this->courseModel->deleteCourse($_REQUEST['courseId']);
        }
        if (isset($result) && $result > 0) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
        } else {
            $response['status'] = '404';
            $response['message'] = 'Không xóa được';
        }

        $jsonData = json_encode($response);
        echo $jsonData;
    }
    public function add_lesson()
    {
        try {
            $lesson = new Lesson();
            $lesson->ID = $this->lessonModel->generateValidLessonID();
            $lesson->Description = $_POST['lesson_desc'];
            $lesson->State = $_POST['lesson_state'];
            $lesson->CourseID = $_POST['course_id'];
            $totalLesson = $this->lessonModel->getTotalLessonInCourse($lesson->CourseID);
            $totalExcercise = $this->excerciseModel->getTotalExcerciseInCourse($lesson->CourseID);
            $lesson->OrderN =  $totalLesson + $totalExcercise + 1;
            $result = $this->lessonModel->addLesson($lesson);
            if ($result >= 1) {
                $redirect = "Location: /administration/courses/edit.php?courseId=" . $lesson->CourseID;
                header($redirect);
                exit;
            }
        } catch (Exception $ex) {
        }
    }
    public function update_lesson()
    {
        try {
            $lesson = new Lesson();
            $lesson->ID = $_POST['lesson_id'];
            $lesson->Description = $_POST['lesson_desc'];
            $lesson->State = $_POST['lesson_state'];
            $lesson->CourseID = $_POST['course_id'];
            $result = $this->lessonModel->updateLesson($lesson);
            if ($result >= 1) {
                $redirect = "Location: /administration/courses/edit.php?courseId=" . $lesson->CourseID;
                header($redirect);
                exit;
            }
        } catch (Exception $ex) {
        }
    }
    public function delete_lesson()
    {
        //
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['lessonId'])) {
            $lesson = $this->lessonModel->getLessonById($_REQUEST['lessonId']);
            $deleteLessonTextFolder = $this->s3Service->deleteFileInFolder('private/text/' . $lesson->CourseID . '/' . $lesson->ID . '/');
            $deleteLessonVideoFolder = $this->s3Service->deleteFileInFolder('private/video/' . $lesson->CourseID . '/' . $lesson->ID . '/');

            $result = $this->lessonModel->deleteLesson($lesson->ID);
        }
        if (isset($result) && $result > 0) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
        } else {
            $response['status'] = '404';
            $response['message'] = 'Không xóa được';
        }

        $jsonData = json_encode($response);
        echo $jsonData;
    }
    public function add_excercise()
    {
        try {
            $excercise = new Excercise();
            $excercise->Description = $_POST['description'];
            $excercise->State = $_POST['excercise_state'];
            $excercise->CourseID = $_POST['course_id'];
            $excercise->Deadline  = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['deadline']);
            $totalExcercise = $this->excerciseModel->getTotalExcerciseInCourse($excercise->CourseID);
            $totalLesson = $this->lessonModel->getTotalLessonInCourse($excercise->CourseID);
            $excercise->OrderN =  $totalLesson + $totalExcercise + 1;
            $result = $this->excerciseModel->addExcercise($excercise);
            if ($result >= 1) {
                $redirect = "Location: /administration/courses/edit.php?courseId=" . $excercise->CourseID;
                header($redirect);
                exit;
            }
        } catch (Exception $ex) {
        }
    }
    public function update_excercise()
    {
        try {
            $excercise = $this->excerciseModel->getExcerciseById($_POST['excercise_id']);
            $excercise->Description = $_POST['description'];
            $excercise->State = $_POST['excercise_state'];
            $excercise->Deadline  = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['deadline']);
            $result = $this->excerciseModel->updateExcercise($excercise);
            if ($result >= 1) {
                $redirect = "Location: /administration/courses/edit.php?courseId=" . $excercise->CourseID;
                header($redirect);
                exit;
            }
        } catch (Exception $ex) {
        }
    }
    public function delete_excercise()
    {
        $response = array();
        $jsonData = "";
        $result = 0;
        if (isset($_REQUEST['excerciseId'])) {
            $result = $this->excerciseModel->deleteExcercise($_REQUEST['excerciseId']);
        }
        if (isset($result) && $result == true) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
        } else {
            $response['status'] = '404';
            $response['message'] = 'Không xóa được';
        }
        $jsonData = json_encode($response);
        echo $jsonData;
    }
    public function add_question()
    {
        foreach ($_POST as $key => $value) {
            if(!is_array($value))
                echo "Field: " . htmlspecialchars($key) . ", Value: " . htmlspecialchars($value) . "<br>";
            else
                {
                    echo "Field: ".htmlspecialchars($key)."<br>";
                    print_r($value);
                    echo "<br>";
                }
        }
    }
    public function delete_question()
    {
        //
    }
    public function sort_program()
    {
        $programs = json_decode(file_get_contents("php://input"), true);
        foreach ($programs as $index => $program) {
            if ($program["type"] == "lesson") {
                $this->lessonModel->updateOrder($program["id"], $index+1);
            } else {
                $this->excerciseModel->updateOrder($program["id"], $index+1);
            }
        }
    }
    public function add_document()
    {
        try {
            $document = new Document();
            $document->ID = $this->documentModel->generateValidDocumentID();
            $document->Description = $_POST['description'];
            $document->State = $_POST['state'];
            $document->LessonID = $_POST['lessonId'];
            $document->Type = $_POST['type'];
            $totalDocInLesson = $this->documentModel->getTotalDocumentInLesson($document->LessonID);
            $document->OrderN = $totalDocInLesson + 1;
            //
            $lesson = $this->lessonModel->getLessonById($document->LessonID);
            $fileSource = $_FILES['document_src']["tmp_name"];
            $filePath = ($document->Type == 'video') ? "private/video/" . $lesson->CourseID . '/' . $lesson->ID . '/' . $document->ID . '/' . $_FILES['document_src']["name"] :
                "private/text/" . $lesson->CourseID . '/' . $lesson->ID . '/' . $document->ID . '/' . $_FILES['document_src']["name"];

            $this->uploadFile($fileSource, $filePath, false);
            $document->DocUri = $filePath;

            $result = $this->documentModel->addDocument($document);
            if ($result >= 1) {
                $lesson = $this->lessonModel->getLessonById($document->LessonID);
                $redirect = "Location: /administration/courses/edit.php?courseId=" . $lesson->CourseID;
                header($redirect);
                exit;
            }
        } catch (Exception $ex) {
            echo $ex;
        }
    }
    public function update_document()
    {
        try {
            $document = $this->documentModel->getDocumentByID($_POST['documentId']);
            $document->Description = $_POST['description'];
            if (strlen($_FILES['document_src']["name"]) > 0) {
                $this->removeFile($document->DocUri);
                $lesson = $this->lessonModel->getLessonById($_POST['lessonId']);
                $fileSource = $_FILES['document_src']["tmp_name"];
                $filePath = ($document->Type == 'video') ? "private/video/" . $lesson->CourseID . '/' . $lesson->ID . '/' . $document->ID . '/' . $_FILES['document_src']["name"] :
                    "private/text/" . $lesson->CourseID . '/' . $lesson->ID . '/' . $document->ID . '/' . $_FILES['document_src']["name"];
                $this->uploadFile($fileSource, $filePath, false);
                $document->DocUri = $filePath;
            }
            $result = $this->documentModel->updateDocument($document);
            if ($result == true) {
                $redirect = "Location: /administration/courses/edit.php?courseId=" . $lesson->CourseID;
                header($redirect);
                exit;
            }
        } catch (Exception $e) {
        }
    }
    public function delete_document()
    {
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['documentId'])) {
            $document = $this->documentModel->getDocumentByID($_REQUEST['documentId']);
            $lesson = $this->lessonModel->getLessonById($document->LessonID);
            if ($document->Type == "video") {
                $deleteDocumentFolder = $this->s3Service->deleteFileInFolder('private/video/' . $lesson->CourseID . '/' . $lesson->ID . '/' . $document->ID) . '/';
            } else {
                $deleteDocumentFolder = $this->s3Service->deleteFileInFolder('private/text/' . $lesson->CourseID . '/' . $lesson->ID . '/' . $document->ID . '/');
            }
            $result = $this->documentModel->deleteDocument($document->ID);
        }
        if ($result == true) {
            $response["status"] = '204';
            $response['message'] = 'Xóa thành công';
            $response['isdeleted'] = $result;
        } else {
            $response['status'] = '404';
            $response['message'] = 'Không xóa được';
            $response['isdeleted'] = $result;
        }

        $jsonData = json_encode($response);
        echo $jsonData;
    }
    public function sort_document()
    {
        $documents = json_decode(file_get_contents("php://input"), true);
        $arr = [];
        foreach ($documents as $index => $id) {
            $this->documentModel->updateOrder($id, $index+1);
        }
        echo json_encode($arr);
    }
    /* Modal */
    public function lesson_modal()
    {
        global $editMode;
        global $course;
        global $lesson;
        $editMode = isset($_REQUEST['editmode']);
        // thêm bài giảng
        if (!$editMode) {
            if (isset($_REQUEST['courseId'])) {
                $course = $this->courseModel->getCourseById($_REQUEST['courseId']);
                requirv("admin/courses/modal/lesson.php");
            } else {
                header('Location: /error');
            }
        } else {
            // Sửa bài giảng
            if (isset($_REQUEST['lessonId'])) {
                $lesson = $this->lessonModel->getLessonById($_REQUEST['lessonId']);
                $course = $this->courseModel->getCourseById($lesson->CourseID);
                requirv("admin/courses/modal/lesson.php");
            } else {
                header('Location: /error');
            }
        }
    }
    public function document_modal()
    {
        global $lesson;
        global $document;
        $lesson = $this->lessonModel->getLessonById($_REQUEST['lessonId']);
        $editMode = isset($_REQUEST['editmode']);
        if ($editMode) {
            $document = $this->documentModel->getDocumentByID($_REQUEST['documentId']);
            $document->DocUri = $this->s3Service->encodeKey($document->DocUri);
        }
        requirv("admin/courses/modal/document.php");
    }
    public function sort_program_modal()
    {
        global $course;
        global $programs;
        if (isset($_REQUEST['courseId'])) {
            $course = $this->courseModel->getCourseById($_REQUEST['courseId']);
            $lessons = $this->lessonModel->getLessonsByCourseId($course->id);
            $excercises = $this->excerciseModel->getExcercisesByCourseId($course->id);
            $programs = array_merge($lessons, $excercises);
            usort($programs, array('AdminCourses', 'compareOrderN'));
            requirv("admin/courses/modal/sort_program.php");
        } else {
            header('Location: /error');
        }
    }
    public function excercise_modal()
    {
        global $course;
        global $excercise;
        $editMode = isset($_REQUEST['editmode']);
        // thêm bài kiểm
        if (!$editMode) {
            if (isset($_REQUEST['courseId'])) {
                $course = $this->courseModel->getCourseById($_REQUEST['courseId']);
                requirv("admin/courses/modal/excercise.php");
            } else {
                header('Location: /error');
            }
        } else {
            // Sửa bài kiểm
            if (isset($_REQUEST['excerciseId'])) {
                $excercise = $this->excerciseModel->getExcerciseById($_REQUEST['excerciseId']);
                $course = $this->courseModel->getCourseById($excercise->CourseID);
                requirv("admin/courses/modal/excercise.php");
            } else {
                header('Location: /error');
            }
        }
    }
    public function sort_document_modal()
    {
        global $lesson;
        global $documents;
        if (isset($_REQUEST['lessonId'])) {
            $lesson = $this->lessonModel->getLessonById($_REQUEST['lessonId']);
            $documents = $this->documentModel->getDocumentsByLessonID($_REQUEST['lessonId']);
            usort($documents, array('AdminCourses', 'compareOrderN'));
            requirv("admin/courses/modal/sort_document.php");
        } else {
            header('Location: /error');
        }
    }
    public function list_question_modal()
    {
        global $excerciseId;
        global $questions;
        $excerciseId  = $_REQUEST['excerciseId'];
        $questions = $this->questionModel->getQuestionByExcerciseID($excerciseId);
        requirv("admin/courses/modal/list_question.php");
    }
    public function question_modal()
    {
        global $question;
        global $excerciseId;
        $excerciseId = $_REQUEST['excerciseId'];
        $editMode = isset($_REQUEST['editmode']);
        if($editMode)
        {

        }
        requirv("admin/courses/modal/question.php");
    }
    private static function compareOrderN($a, $b)
    {
        return $a->OrderN - $b->OrderN;
    }
    /* Khác */
    private function saveImageToFolder($courseID)
    {
        $relativeDir = 'public/' . 'poster/' . $courseID . '/';

        $relativeFilePath = $relativeDir . basename($_FILES['course_poster']["name"]);
        $fileSource = $_FILES['course_poster']["tmp_name"];
        $result = $this->s3Service->uploadFileToBucket($fileSource, $relativeFilePath);
        return $relativeFilePath;
    }
    private function uploadFile($fileSource, $filePath, $isPublic = true)
    {
        $result = $this->s3Service->uploadFileToBucket($fileSource, $filePath, $isPublic);
        return str_replace($this->s3Service->getBasePath(), '', $result['ObjectURL']);
    }
    private function removeFile($filePath)
    {
        $this->s3Service->deleteFileInBucket($filePath);
    }
}

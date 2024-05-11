<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/CourseModel.php');
requirm('/dao/LessonModel.php');
requirm('/dao/DocumentModel.php');
requirm('/dao/ExcerciseModel.php');
requirm('/dao/SubscriptionModel.php');
requirm('/dao/TrackingModel.php');
requirm('/dao/ExcersResponseModel.php');
requirm('/dao/QuestionModel.php');


requirm('/learn/Course.php');
requirm('/learn/Lesson.php');
requirm('/learn/Document.php');
requirm('/learn/Excercise.php');
requirm('/learn/Subscription.php');
requirm('/learn/Tracking.php');
requirm('/learn/Question.php');
requirm('/dao/profile.php');


requirm('/excerciseresponse/ExcersResponse.php');



requirl('/services/S3Service.php');
class Courses
{
    public CourseModel $courseModel;
    public LessonModel $lessonModel;
    public DocumentModel $documentModel;
    public ExcerciseModel $excerciseModel;
    public SubscriptionModel $subscriptionModel;
    public TrackingModel $trackingModel;
    public QuestionModel $questionModel;
    public ExcersResponseModel $excersResponseModel;
    public S3Service $s3Service;


    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->lessonModel = new LessonModel();
        $this->documentModel = new DocumentModel();
        $this->excerciseModel = new ExcerciseModel();
        $this->subscriptionModel = new SubscriptionModel();
        $this->trackingModel = new TrackingModel();
        $this->questionModel = new QuestionModel();
        $this->excersResponseModel = new ExcersResponseModel();
        $this->s3Service =  new S3Service();
    }
    public function all()
    {
        requirv("courses/all-courses.php");
        global $page;
        $page = new AllCoursesPage();
        $page->courses = array_slice($this->courseModel->getAllCourseBySearch(), 0, 5);
        $page->tutors = ProfileDAO::getProfileByType(0);
        $page->basePath = $this->s3Service->getBasePath();
        if ($page->courses != null) {
            foreach ($page->courses as $key => $course) {
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
    public function learn($profileID, $courseID)
    {
        requirv("courses/learn.php");
        global $page;
        $page = new LearnPage();
        if (isset($_GET['documentId'])) {
            $page->currentProgram = $this->documentModel->getDocumentByID($_GET['documentId']);
            $page->currentProgram->DocUri = $this->s3Service->presignUrl($page->currentProgram->DocUri, '');
        } elseif (isset($_GET['excerciseId'])) {
            $page->currentProgram = $this->excerciseModel->getExcerciseById($_GET['excerciseId']);
            $this->loadQuestions($page->currentProgram);
        }
        $page->tracking = $this->trackingModel->getTrackingsByProfileAndCourse($profileID, $courseID);
        $page->course = $this->courseModel->getCourseById($courseID);
        $lessons = $this->lessonModel->getLessonsByCourseId($courseID);
        foreach ($lessons as $lesson) {
            $lesson->Documents = $this->documentModel->getDocumentsByLessonID($lesson->ID);
            usort($lesson->Documents, array('Courses', 'compareOrderN'));
        }
        $excercises = $this->excerciseModel->getExcercisesByCourseId($courseID);
        $page->programs = array_merge($lessons, $excercises);
        $page->tracking = $this->trackingModel->getTrackingsByProfileAndCourse($profileID, $courseID);
        $page->profileID = $profileID;
        usort($page->programs, array('Courses', 'compareOrderN'));

        requira("_layout.php");
    }


    /* Ajax call function */
    public function update_tracking()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $checkState = $data['checked'];
        $response = array();

        if ($checkState == 'checked') {
            $tracking = new Tracking();
            $tracking->ProfileID = $data['profileId'];
            $tracking->CourseID = $data['courseId'];
            $tracking->LearnedDocumentID = $data['documentId'];
            $tracking->AtDateTime = new DateTime('now');
            $result = $this->trackingModel->addTracking($tracking);
        } else {
            $result=  $this->trackingModel->deleteTracking($data['profileId'], $data['courseId'], $data['documentId']);
        }
        $response['message'] = ($result == true) ? "Cập nhập thành công" : "Cập nhật thất bại";
        echo json_encode($response);
    }
    public function get_total_page()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $courses = $this->courseModel->getAllCourseBySearch($data['name'], $data['tutor']);
        $totalCourses = count($courses);
        $totalPages = $totalCourses / 5;

        echo json_encode(ceil($totalPages));
    }
    public function get_course_by_page()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $response = array();

        $response['page'] = $data['page'];
        $courses = $this->courseModel->getCourseFromPage(intval($data['page']), 5, $data['name'], $data['tutor']);
        if ($courses != null) {
            foreach ($courses as $key => $course) {
                $course->lessons = $this->lessonModel->getLessonsByCourseId($course->id);
            }
        }
        $response['course'] = $courses;
        echo json_encode($response);
    }
    public function get_course_id()
    {
        $response= array();
        if (isset($_GET['courseId']))
        {
            $course = $this->courseModel->getCourseById($_GET['courseId']);
            $response['data'] = $course;
        }else{
            $response['message'] = 'Có lỗi xảy ra';
        }
        echo json_encode($response);
    }
    public function submit_test()
    {
       $courseId = $_POST['courseId'];
       $excercise = $_POST['excerciseId'];
       $caus = $_POST['cau'];

       $excersResponse = new ExcersResponse();
       $excersResponse->ID= $this->excersResponseModel->generateExcersResponseID();
       $excersResponse->AtDateTime = new DateTime();
       $excersResponse->ProfileID =$_POST['profileId'];
       $excersResponse->ExcerciseID = $excercise;

       $this->excersResponseModel->addEcersResponse($excersResponse);
       foreach($caus as $index => $cau)
       {
         $answer = new Answer();
         $answer->QuestionID = intval($cau['questionId']);
         $answer->ExcsRespID = $excersResponse->ID;

         $newAnswerId = $this->excersResponseModel->addAnswer($answer);

            switch($cau['type'])
            {
                case 'multi_option':
                    foreach($cau['option_select'] as $index=>$optionKey)
                    {
                       $aMulopCh = new AMulchOption();
                       $aMulopCh->QOptID = $optionKey;
                       $aMulopCh->AnsID = $newAnswerId;
                       $this->excersResponseModel->addAMulchOption($aMulopCh); 
                    }
                    break;
                case 'matching':
                    foreach($cau['matching'] as $index=>$matching)
                    {
                        $aMatching = new AMatching();
                        $aMatching->AnsID = $newAnswerId;
                        $aMatching->QMat = $matching;
                        $aMatching->QMatKey = $cau['matchingkey'][$index];

                        $this->excersResponseModel->addAMatching($aMatching);
                        
                    }
                    break;
                case 'completion':
                    foreach($cau['masks_id'] as $key=>$maskId)
                    {
                        $aCompMask  = new ACompMask();
                        $aCompMask->AnswerID = $newAnswerId;
                        $aCompMask->QCoMaskID = $maskId;
                        $aCompMask->Content = $cau['masks_content'][$key];

                        $this->excersResponseModel->addACompMask($aCompMask);
                    }
                    break;
            }
       }
    }
    /* Khác */
    public function isRegisteredToCourse($profileID, $courseID)
    {
        return $this->subscriptionModel->getSubscriptionByProAndCourse($profileID, $courseID);
    }
    private static function compareOrderN($a, $b)
    {
        return $a->OrderN - $b->OrderN;
    }
    public function loadQuestions(Excercise &$excercise)
    {
            $excercise->questions = $this->questionModel->getQuestionByExcerciseID($excercise->ID);
            foreach($excercise->questions as $key => $question)
            {
                $question->main = $this->loadSingleQuestion($question->ID);
            }
    }
    public function loadSingleQuestion($questionId)
    {
        $qmulchoption = $this->questionModel->getQMulchOptionByQuestion($questionId);
        if (!empty($qmulchoption))
        {
            return $qmulchoption;
        }
        $qmatchings = $this->questionModel->getQMatchingByQuestion($questionId);
        if(!(empty($qmatchings)))
        {
            foreach($qmatchings as $key => $value){
                $value->QMatchingKey = $this->questionModel->getQMatchingKey($value->KeyQ);
            }

            return $qmatchings;
        }

        $qcompletion = $this->questionModel->getQCompletionByQuestion($questionId);
        if(isset($qcompletion))
        {
            $qcompletion->mask = $this->questionModel->getQCompletionMaskByQCompletion($qcompletion->ID);
            return $qcompletion;
        }
        return null;
    }
}

<?
require_once "/var/www/html/_lib/utils/requir.php";
requirv("introduction/home.php");
requirm('dao/CourseModel.php');
requirm('dao/LessonModel.php');
requirm('dao/SubscriptionModel.php');

requirl('services/S3Service.php');
global $page;
$model = new CourseModel();
$lessonModel = new LessonModel();
$s3Service = new S3Service();
$subscriptionModel = new SubscriptionModel();
$allCourse =  $model->getAllCourseBySearch();
shuffle($allCourse);

$page = new CoursesIntroductionHomePage();
$page->courses = array_slice($allCourse,0,5);
foreach($page->courses as $key=>$course)
{
    $course->lessons = $lessonModel->getLessonsByCourseId($course->id,1);
    $course->totalStudent = $subscriptionModel->getTotalStudentOfCourse($course->id);
    $course->posterURI = $s3Service->encodeKey($course->posterURI);
}
$page->basePath = $s3Service->getBasePath();

requira("_layout.php");
?>
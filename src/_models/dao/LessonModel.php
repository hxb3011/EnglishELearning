<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Lesson.php');
class LessonModel
{
    public function getLessonById($lessonId)
    {
    }
    public function getLessonsByCourseId($courseId)
    {
        $sqlQuery = "SELECT * FROM lesson WHERE CourseID = ?";
        $params = array(
            'CourseID' => $courseId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $lessons = [];
                foreach ($result as $index => $value) {
                    $lesson = new Lesson();
                    $lesson->constructFromArray($value);
                    $lessons[] = $lesson;
                }
                return $lessons;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
}

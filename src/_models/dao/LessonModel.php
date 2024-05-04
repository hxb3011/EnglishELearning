<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Lesson.php');
class LessonModel
{
    public function generateValidLessonID()
    {
        $max = $this->getNumberOfTotalLesson();
        $max = $max + 1;
        return 'LESSON' . $max;
    }
    public function getNumberOfTotalLesson()
    {
        $sqlQuery = "SELECT COUNT(*) AS total_lessons FROM lesson";
        try {
            $result = Database::executeQuery($sqlQuery);
            return intval($result[0]['total_lessons']);
        } catch (Exception $e) {
            return 0;
        }
    }
    public function getLessonById($lessonId)
    {
        $sqlQuery = "SELECT * FROM lesson WHERE ID = ?";
        $params = array(
            'id' => $lessonId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $lesson = new Lesson();
                foreach ($result as $index => $value) {
                    $lesson->constructFromArray($value);
                }
                return $lesson;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
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
    public function addLesson(Lesson $lesson){
        $sqlQuery = "INSERT INTO lesson(ID,Description,State,CourseID,OrderN) VALUES(?,?,?,?,?)";
        $params = array(
            "id" => $lesson->ID,
            "Description" => $lesson->Description,
            "State"=> $lesson->State,
            "CourseID"=>$lesson->CourseID,
            "OrderN" => $lesson->OrderN
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function updateLesson(Lesson $lesson){
        $sqlQuery = "UPDATE lesson SET Description = ?,State = ? WHERE id=?";
        $params = array(
            "Description" => $lesson->Description,
            "State"=> $lesson->State,
            "id" => $lesson->ID
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function getTotalLessonInCourse($courseId)
    {
        $sqlQuery = "SELECT COUNT(*) AS total_lessons FROM lesson WHERE CourseID = ?";
        $params = array(
            "courseid"=> $courseId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            return intval($result[0]['total_lessons']);
        } catch (Exception $e) {
            return false;
        }
    }
    public function updateOrder(string $lessonId,int $orderN)
    {
        $sqlQuery = "UPDATE lesson SET OrderN = ? WHERE ID = ?";
        $params = array(
            $orderN,
            $lessonId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return 0;
        }
    }
    public function deleteLesson(string $lessonId)
    {
        $sqlQuery = "DELETE FROM lesson WHERE ID = ? ";
        $params = array(
            $lessonId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return 0;
        }
    }
}

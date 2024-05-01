<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Course.php');
class CourseModel
{
    public function getNumberOfTotalCourse()
    {
        $sqlQuery = "SELECT COUNT(*) AS total_courses FROM course";
        try {
            $result = Database::executeQuery($sqlQuery);
            return intval($result[0]['total_courses']);
        } catch (Exception $e) {
            return 0;
        }
    }
    public function generateValidCourseID()
    {
        $max = $this->getNumberOfTotalCourse();
        $max = $max + 1;
        return 'COURSE' . $max;
    }
    public function getAllCourse()
    {
        $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID";
        try {
            $result = Database::executeQuery($sqlQuery);
            if ($result != null) {
                $courses = [];
                foreach ($result as $index => $value) {
                    $course = new Course();
                    $course->constructFromArray($value);

                    $courses[] = $course;
                }
                return $courses;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public function getCourseById($id)
    {
        $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID AND course.ID =?";
        $params = array(
            'id' => $id
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $course = new Course();
                foreach ($result as $index => $value) {
                    $course->constructFromArray($value);
                }
                return $course;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public function addCourse(Course $course)
    {
        $sqlQuery = "INSERT INTO course(ID,Name,PosterUri,Description,State,ProfileID,BeginDate,EndDate,Price) VALUES (?,?,?,?,?,?,STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'),STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'),?)";
        $params = array(
            "id" => $course->id,
            "name" => $course->name,
            "posteruri" => $course->posterURI,
            "description" => $course->description,
            "state" => $course->state,
            "profileid" => $course->profileID,
            "begindate" => $course->beginDate->format('d-m-Y H:i:s'),
            "enddate" => $course->endDate->format('d-m-Y H:i:s'),
            "price" => $course->price,
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function updateCourse(Course $course)
    {
        $params = array();
        $params = array(
            "name" => $course->name,
            "description" => $course->description,
            "state" => $course->state,
            "profileid" => $course->profileID,
            "begindate" => $course->beginDate->format('d-m-Y H:i:s'),
            "enddate" => $course->endDate->format('d-m-Y H:i:s'),
            "price" => $course->price,
            "posteruri" => $course->posterURI,
            "id" => $course->id,
        );
        $sqlQuery = "UPDATE course SET Name=?,Description=?,State=?,ProfileID=?,BeginDate=STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'),EndDate=STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'),Price=?,PosterUri=? WHERE ID=?";
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
}

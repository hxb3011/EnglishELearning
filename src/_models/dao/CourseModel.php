<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/learn/Course.php');
class CourseModel
{

    /* ADMIN  */
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
            return 0;
        }
    }
    public function deleteCourse($courseId)
    {
        $sqlQuery = "DELETE FROM course WHERE ID = ?";
        $params = [
            $courseId
        ];
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return 0;
        }
    }
    public function getAllCourse($courseName = "", $profileId = "")
    {
        //$sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID";
        if ($profileId != "") {
            $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID  AND course.name LIKE CONCAT('%', ?, '%') AND profile.ID= ? ";
            $params = array(
                $courseName,
                $profileId
            );
        } else {
            $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID  AND course.name LIKE CONCAT('%', ?, '%') ";
            $params = array(
                $courseName,
            );
        }
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $courses = [];
                foreach ($result as $index => $value) {
                    $course = new Course();
                    $course->constructFromArray($value);

                    $courses[] = $course;
                }
                return $courses;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    public function getCourseFromPage($page = 1, $perPage = 5, $courseName = "", $profileId = "")
    {
        $offSet = ($page - 1) * $perPage;
        if ($profileId != "") {
            $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID  AND course.name LIKE CONCAT('%', ?, '%') AND profile.ID= ?  LIMIT $offSet, $perPage";
            $params = array(
                $courseName,
                $profileId
            );
        } else {
            $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID  AND course.name LIKE CONCAT('%', ?, '%') LIMIT $offSet, $perPage";
            $params = array(
                $courseName,
            );
        }
        try {
            $result = Database::executeQuery($sqlQuery, $params);
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
        }
    }
    /* SHARE */
    public function getCourseById($id)
    {
        $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID AND course.ID =? AND Status=1";
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
    /* CLIENT */
    public function getAllCourseBySearch($courseName = "", $profileId = "", $startPrice = null, $endPrice = null)
    {
        if ($startPrice != null && $endPrice != null) {
            $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID  AND course.Name LIKE CONCAT('%', ?, '%') AND profile.ID LIKE CONCAT('%', ?, '%') AND course.Price >= ? AND course.Price <= ? AND State= 1";
            $params = array(
                $courseName,
                $profileId,
                $startPrice,
                $endPrice
            );
        } else {
            $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID  AND course.Name LIKE CONCAT('%', ?, '%') AND profile.ID LIKE CONCAT('%', ?, '%') AND State= 1";
            $params = array(
                $courseName,
                $profileId
            );
        }

        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $courses = [];
                foreach ($result as $index => $value) {
                    $course = new Course();
                    $course->constructFromArray($value);

                    $courses[] = $course;
                }
                return $courses;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    public function getCourseFromPage2($page = 1, $perPage = 5, $courseName = "", $profileId = "", $startPrice = null, $endPrice = null)
    {
        $offSet = ($page - 1) * $perPage;
        if($startPrice != null && $endPrice != null)
        {
            $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID  AND course.name LIKE CONCAT('%', ?, '%') AND profile.ID LIKE CONCAT('%', ?, '%')  AND State=1 AND course.Price >= ? AND course.Price <= ? LIMIT $offSet, $perPage";
            $params = array(
                $courseName,
                $profileId,
                $startPrice,
                $endPrice
            );
        }else{
            $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID  AND course.name LIKE CONCAT('%', ?, '%') AND profile.ID LIKE CONCAT('%', ?, '%')  AND State=1 LIMIT $offSet, $perPage";
            $params = array(
                $courseName,
                $profileId
            );
        }
        try {
            $result = Database::executeQuery($sqlQuery, $params);
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
        }
    }
}

<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Excercise.php');
class ExcerciseModel
{
    public function getExcerciseById($excerciseId)
    {
        $sqlQuery = "SELECT * FROM excercise WHERE ID = ?";
        $params = array(
            'id' => $excerciseId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $excercise = new Excercise();
                foreach ($result as $index => $value) {
                    $excercise->constructFromArray($value);
                }
                return $excercise;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public function getExcercisesByCourseId($courseId)
    {
        $sqlQuery = "SELECT * FROM excercise WHERE CourseID = ?";
        $params = array(
            'CourseID' => $courseId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $excercises = [];
                foreach ($result as $index => $value) {
                    $excercise = new Excercise();
                    $excercise->constructFromArray($value);
                    $excercises[] = $excercise;
                }
                return $excercises;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    public function addExcercise(Excercise $excercise)
    {
        $sqlQuery  = "INSERT INTO excercise(Description,Deadline,State,CourseID,OrderN) VALUES(?,STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'),?,?,?)";
        $params = array(
            "description" => $excercise->Description,
            "deadline" => $excercise->Deadline->format('d-m-Y H:i:s'),
            "state"=>$excercise->State,
            "courseid"=>$excercise->CourseID,
            "ordern"=>$excercise->OrderN
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function updateLesson(Excercise $excercise){
        $sqlQuery = "UPDATE excercise SET Description = ?,Deadline = STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'),State = ?,OrderN=? WHERE id=?";
        $params = array(
            "description" => $excercise->Description,
            "deadline" => $excercise->Deadline->format('d-m-Y H:i:s'),
            "state"=>$excercise->State,
            "ordern"=>$excercise->OrderN,
            "id"=>$excercise->ID
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function getTotalExcerciseInCourse($courseId)
    {
        $sqlQuery = "SELECT COUNT(*) AS total_excercises FROM excercise WHERE CourseID = ?";
        $params = array(
            "courseid"=> $courseId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            return intval($result[0]['total_excercises']);
        } catch (Exception $e) {
            return false;
        }
    }
}

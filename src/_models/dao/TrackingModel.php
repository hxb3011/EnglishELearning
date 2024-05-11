<?

use function PHPSTORM_META\type;

require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/learn/Tracking.php');
class TrackingModel
{

    public function addTracking(Tracking $tracking)
    {
        $sqlQuery  = "INSERT INTO tracking(ProfileID,CourseID,LearnedDocumentID,AtDateTime) VALUES(?,?,?,STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'))";
        $params = array(
            $tracking->ProfileID,
            $tracking->CourseID,
            $tracking->LearnedDocumentID,
            $tracking->AtDateTime->format('d-m-Y H:i:s')
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteTracking(string $ProfileID, string $CourseID,string $LearnedDocumentID)
    {
        $sqlQuery  = "DELETE FROM tracking WHERE ProfileID = ? AND CourseID = ? AND LearnedDocumentID = ?";
        $params = array(
            $ProfileID,
            $CourseID,
            $LearnedDocumentID,
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getTrackingsByProfileAndCourse($ProfileID, $CourseID)
    {
        $sqlQuery = "SELECT * FROM tracking WHERE ProfileID = ? AND CourseID= ?";
        $params = array(
            $ProfileID,
            $CourseID
        );
        $result = Database::executeQuery($sqlQuery, $params);
        if ($result != null) {
            $trackings = [];
            foreach ($result as $index => $value) {
                $tracking = new Tracking();
                $tracking->constructFromArray($value);
                $trackings[] = $tracking;
            }
            return $trackings;
        } else {
            return array();
        }
    }
}

<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/dictionary/LearntRecord.php');
class LearntRecordModel {

    public function getLearntRecordBy_ProfileID($ProfileID)
    {
        $sqlQuery = "SELECT * FROM LearntRecord WHERE ProfileID like ?";
        $params = array(
            'ProfileID' => $ProfileID,
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $LearntRecords = [];
                foreach ($result as $index => $value) {
                    $LearntRecord = new LearntRecord();
                    $LearntRecord->constructFromArray($value);
                    $LearntRecords[] = $LearntRecord;
                }
                return $LearntRecords;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function getLearntRecordBy_MeaningID($MeaningID)
    {
        $sqlQuery = "SELECT * FROM LearntRecord WHERE MeaningID = ?";
        $params = array(
            'MeaningID' => $MeaningID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $LearntRecords = [];
                foreach ($result as $index => $value) {
                    $LearntRecord = new LearntRecord();
                    $LearntRecord->constructFromArray($value);
                    $LearntRecords[] = $LearntRecord;
                }
                return $LearntRecords;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function addLearntRecord(LearntRecord $LearntRecord){
        $sql = "INSERT INTO LearntRecord (ProfileID, MeaningID, LastReviewed) VALUES (?, ?, ?)";
        $params = array(
            "ProfileID" => $LearntRecord->profileID,
            "MeaningID" => $LearntRecord->meaningID,
            "LastReviewed" => $LearntRecord->lastReviewed,
        );
        try{    
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    // public function updateLearntRecord(LearntRecord $LearntRecord){
    //     $sql = "UPDATE LearntRecord SET LastReviewed = ? WHERE ProfileID = ? AND MeaningID = ?";
    //     $params = array(
    //         "LastReviewed" => $LearntRecord->lastReviewed,
    //         "ProfileID" => $LearntRecord->profileID,
    //         "MeaningID" => $LearntRecord->meaningID,
    //     );
    //     try{
    //         $result = Database::executeNonQuery($sql,$params);
    //         return $result;
    //     } catch (Exception $e){
    //         return false;
    //     }
    // }

    public function deleteLearntRecord(LearntRecord $LearntRecord){
        $sql = "DELETE FROM LearntRecord WHERE ProfileID = ? AND MeaningID = ?";
        $params = array(
            "ProfileID" => $LearntRecord->profileID,
            "MeaningID" => $LearntRecord->meaningID,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }
}
?>
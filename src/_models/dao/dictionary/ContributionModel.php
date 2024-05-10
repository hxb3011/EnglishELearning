<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/dictionary/Contribution.php');
class ContributionModel {

    public function getContributionBy_ProfileID($ProfileID)
    {
        $sqlQuery = "SELECT * FROM Contribution WHERE ProfileID = ?";
        $params = array(
            'ProfileID' => $ProfileID,
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $contributions = [];
                foreach ($result as $index => $value) {
                    $contribution = new Contribution();
                    $contribution->constructFromArray($value);
                    $contributions[] = $contribution;
                }
                return $contributions;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function getContributionBy_MeaningID($MeaningID)
    {
        $sqlQuery = "SELECT * FROM Contribution WHERE MeaningID = ?";
        $params = array(
            'MeaningID' => $MeaningID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $contributions = [];
                foreach ($result as $index => $value) {
                    $contribution = new Contribution();
                    $contribution->constructFromArray($value);
                    $contributions[] = $contribution;
                }
                return $contributions;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function addContribution(Contribution $Contribution){
        $sql = "INSERT INTO Contribution (ProfileID, MeaningID, Accepted) VALUES (?, ?, ?)";
        $params = array(
            "ProfileID" => $Contribution->profileID,
            "MeaningID" => $Contribution->meaningID,
            "Accepted" => $Contribution->accepted,
        );
        try{    
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function updateContribution(Contribution $Contribution){
        $sql = "UPDATE Contribution SET Accepted = ? WHERE ProfileID = ? AND MeaningID = ?";
        $params = array(
            "Accepted" => $Contribution->accepted,
            "ProfileID" => $Contribution->profileID,
            "MeaningID" => $Contribution->meaningID,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function deleteContribution(Contribution $Contribution){
        $sql = "DELETE FROM Contribution WHERE ProfileID = ? AND MeaningID = ?";
        $params = array(
            "ProfileID" => $Contribution->profileID,
            "MeaningID" => $Contribution->meaningID,
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
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

    public function getContributionBy_LemmaID($LemmaID)
    {
        $sqlQuery = "SELECT * FROM Contribution WHERE LemmaID like ?";
        $params = array(
            'LemmaID' => $LemmaID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $contribution = new Contribution();
                foreach ($result as $index => $value) {
                    $contribution->constructFromArray($value);
                }
                return $contribution;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function addContribution(Contribution $Contribution){
        $sql = "INSERT INTO Contribution (ProfileID, LemmaID, Accepted) VALUES (?, ?, ?)";
        $params = array(
            "ProfileID" => $Contribution->profileID,
            "LemmaID" => $Contribution->lemmaID,
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
        $sql = "UPDATE Contribution SET Accepted = ? WHERE ProfileID = ? AND LemmaID = ?";
        $params = array(
            "Accepted" => $Contribution->accepted,
            "ProfileID" => $Contribution->profileID,
            "LemmaID" => $Contribution->lemmaID,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function deleteContribution(Contribution $Contribution){
        $sql = "DELETE FROM Contribution WHERE ProfileID = ? AND LemmaID = ?";
        $params = array(
            "ProfileID" => $Contribution->profileID,
            "LemmaID" => $Contribution->lemmaID,
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
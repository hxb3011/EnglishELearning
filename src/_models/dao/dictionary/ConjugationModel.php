<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/dictionary/Conjugation.php');
class ConjugationModel {

    public function getConjugationBy_InfinitiveID($infinitiveID)
    {
        $sqlQuery = "SELECT * FROM Conjugation WHERE InfinitiveID like ?";
        $params = array(
            'InfinitiveID' => $infinitiveID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            $conjugations = [];
            if ($result != null) {
                foreach ($result as $index => $value) {
                    $Conjugation = new Conjugation();
                    $Conjugation->constructFromArray($value);
                    $conjugations[] = $Conjugation;
                }
                return $conjugations;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public function getConjugationBy_AlternativeID($AlternativeID)
    {
        $sqlQuery = "SELECT * FROM Conjugation WHERE AlternativeID like ?";
        $params = array(
            'AlternativeID' => $AlternativeID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $Conjugation = new Conjugation();
                foreach ($result as $index => $value) {
                    $Conjugation->constructFromArray($value);
                }
                return $Conjugation;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    
    // public function addConjugation(Conjugation $Conjugation){
    //     $sql = "INSERT INTO Conjugation (InfinitiveID, AlternativeID, Description) VALUES (?, ?, ?)";
    //     $params = array(
    //         "InfinitiveID" => $Conjugation->infinitiveID,
    //         "AlternativeID" => $Conjugation->alternativeID,
    //         "Description" => $Conjugation->description
    //     );
    //     try{
    //         $result = Database::executeNonQuery($sql,$params);
    //         return $result;
    //     } catch (Exception $e){
    //         return false;
    //     }
    // }

    public function addConjugation($infinitiveID,$alternativeID,$description){
        $sql = "INSERT INTO Conjugation (InfinitiveID, AlternativeID, Description) VALUES (?, ?, ?)";
        $params = array(
            "InfinitiveID" => $infinitiveID,
            "AlternativeID" => $alternativeID,
            "Description" => $description
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function updateConjugation(Conjugation $Conjugation){
        $sql = "UPDATE Conjugation SET Description = ? WHERE InfinitiveID = ? AND AlternativeID like ?";
        $params = array(
            "Description" => $Conjugation->description,
            "InfinitiveID" => $Conjugation->infinitiveID,
            "AlternativeID" => $Conjugation->alternativeID,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function deleteConjugation(Conjugation $Conjugation){
        $sql = "DELETE FROM Conjugation WHERE InfinitiveID like= ?";
        $params = array(
            "InfinitiveID" => $Conjugation->infinitiveID,
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
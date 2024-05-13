<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/dictionary/Meaning.php');
class MeaningModel {

    public function getMeaningByID($ID){
        $sqlQuery = "SELECT * FROM Meaning WHERE ID like ?";
        $params = array(
            'ID' => $ID,
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                    $Meaning = new Meaning();
                foreach ($result as $index => $value) {
                    $Meaning->constructFromArray($value);
                }
                return $Meaning;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function getMeaningByLemmaID($LemmaID)
    {
        $sqlQuery = "SELECT * FROM Meaning WHERE LemmaID like ?";
        $params = array(
            'LemmaID' => $LemmaID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $meanings = [];
                foreach ($result as $index => $value) {
                    $Meaning = new Meaning();
                    $Meaning->constructFromArray($value);
                    $meanings[] = $Meaning;
                }
                return $meanings;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public function addMeaning(Meaning $Meaning){
        $sql = "INSERT INTO Meaning (ID, LemmaID, Meaning, Explanation, LevelV, Note) VALUES (?, ?, ?, ?, ?, ?)";
        $params = array(
            "ID" => $Meaning->ID,
            "LemmaID" => $Meaning->lemmaID,
            "Meaning" => $Meaning->meaning,
            "Explanation" => $Meaning->explanation,
            "LevelV" => $Meaning->levelV,
            "Note" => $Meaning->note,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function updateMeaning(Meaning $Meaning){
        $sql = "UPDATE Meaning SET LemmaID = ?, Meaning = ?, Explanation = ?, LevelV = ?, Note = ? WHERE ID like ?";
        $params = array(
            "LemmaID" => $Meaning->lemmaID,
            "Meaning" => $Meaning->meaning,
            "Explanation" => $Meaning->explanation,
            "LevelV" => $Meaning->levelV,
            "Note" => $Meaning->note,
            "ID" => $Meaning->ID,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function deleteMeaning(Meaning $Meaning){
        $sql = "DELETE FROM Meaning WHERE ID like ?";
        $params = array(
            "ID" => $Meaning->ID,
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
<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/dictionary/Example.php');
class ExampleModel {

    public function getExampleByID($ID)
    {
        $sqlQuery = "SELECT * FROM Example WHERE ID like ?";
        $params = array(
            'id' => $ID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $Example = new Example();
                foreach ($result as $index => $value) {
                    $Example->constructFromArray($value);
                }
                return $Example;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function getExampleByMeaningID($meaningID)
    {
        $sqlQuery = "SELECT * FROM Example WHERE MeaningID like ?";
        $params = array(
            'MeaningID' => $meaningID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $Examples = [];
                foreach ($result as $index => $value) {
                    $Example = new Example();
                    $Example->constructFromArray($value);
                    $Examples[] = $Example;
                }
                return $Examples;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    
    public function exampleExist($meaningID){
        $sql = "SELECT * from example WHERE MeaningID = ?";
        $params = array(
            "MeaningID" => $meaningID,
        );
        try{
            $result =Database::executeQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function addExample(Example $Example){
        $sql = "INSERT INTO Example (MeaningID, Example, Explanation) VALUES (?, ?, ?)";
        $params = array(
            "MeaningID" => $Example->meaningID,
            "Example" => $Example->example,
            "Explanation" => $Example->explanation
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function updateExample(Example $Example){
        $sql = "UPDATE Example SET Example = ?, Explanation = ? WHERE ID like ?";
        $params = array(
            "Example" => $Example->example,
            "Explanation" => $Example->explanation,
            "ID" => $Example->ID,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function deleteExample(Example $Example){
        $sql = "DELETE FROM Example WHERE ID like ?";
        $params = array(
            "ID" => $Example->ID,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }
    public function deleteExamplesBy_MeaningID($meaningID){
        $sql = "DELETE FROM Example WHERE MeaningID like ?";
        $params = array(
            "MeaningID" => $meaningID,
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
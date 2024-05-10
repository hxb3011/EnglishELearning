<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/dictionary/Lemma.php');
class LemmaModel {

    public function liveSearch($key)
    {
        $sqlQuery = "SELECT * FROM Lemma WHERE KeyL like CONCAT(?,'%')" ;
        $params = array(
            'KeyL' => $key
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $lemmas = [];
                foreach ($result as $index => $value) {
                    $Lemma = new Lemma();
                    $Lemma->constructFromArray($value);
                    $lemmas[] = $Lemma;
                }
                return $lemmas;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public function getLemmaByKeyL($key)
    {
        $sqlQuery = "SELECT * FROM Lemma WHERE KeyL like ?" ;
        $params = array(
            'KeyL' => $key
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $Lemma = new Lemma();
                foreach ($result as $index => $value) {
                    $Lemma->constructFromArray($value);
                }
                return $Lemma;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function getLemmaByID($ID)
    {
        $sqlQuery = "SELECT * FROM Lemma WHERE ID like ?";
        $params = array(
            'id' => $ID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $Lemma = new Lemma();
                foreach ($result as $index => $value) {
                    $Lemma->constructFromArray($value);
                }
                return $Lemma;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function addLemma(Lemma $Lemma){
        $sql = "INSERT INTO Lemma (ID, KeyL, PartOfSpeech) VALUES (?, ?, ?)";
        $params = array(
            "ID" => $Lemma->ID,
            "KeyL" => $Lemma->keyL,
            "PartOfSpeech" => $Lemma->partOfSpeech,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function updateLemma(Lemma $Lemma){
        $sql = "UPDATE Lemma SET KeyL = ?, PartOfSpeech = ? WHERE ID like ?";
        $params = array(
            "Lemma" => $Lemma->Lemma,
            "Explanation" => $Lemma->explanation,
            "ID" => $Lemma->ID
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function deleteLemma(Lemma $Lemma){
        $sql = "DELETE FROM Lemma WHERE ID = ?";
        $params = array(
            "ID" => $Lemma->ID,
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
<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/dictionary/Pronunciation.php');
class PronunciationModel {

    public function getPronunciationByID($LemmaID, $Region)
    {
        $sqlQuery = "SELECT * FROM Pronunciation WHERE LemmaID like ? AND Region like ?";
        $params = array(
            'LemmaID' => $LemmaID,
            'Region' => $Region,
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $pronuciations = [];
                foreach ($result as $index => $value) {
                    $pronunciation = new Pronunciation();
                    $pronunciation->constructFromArray($value);
                    $pronuciations[] = $pronunciation;
                }
                return $pronunciations;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function getPronunciationByLemmaID($LemmaID)
    {
        $sqlQuery = "SELECT * FROM Pronunciation WHERE LemmaID like ?";
        $params = array(
            'LemmaID' => $LemmaID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $pronunciations = [];
                foreach ($result as $index => $value) {
                    $pronunciation = new Pronunciation();
                    $pronunciation->constructFromArray($value);
                    $pronunciations[] = $pronunciation;
                }
                return $pronunciations;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function addPronunciation(Pronunciation $pronunciation){
        $sql = "INSERT INTO pronunciation (LemmaID, Region, IPA, Voice) VALUES (?, ?, ?, ?)";
        $params = array(
            "LemmaID" => $pronunciation->lemmaID,
            "Region" => $pronunciation->region,
            "IPA" => $pronunciation->IPA,
            "Voice" => $pronunciation->voice
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function updatePronunciation(Pronunciation $pronunciation){
        $sql = "UPDATE pronunciation SET Region = ?, IPA = ?, Voice = ? WHERE LemmaID like ?";
        $params = array(
            "Region" => $pronunciation->region,
            "IPA" => $pronunciation->IPA,
            "Voice" => $pronunciation->voice,
            "LemmaID" => $pronunciation->lemmaID,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function deletePronunciation(Pronunciation $pronunciation){
        $sql = "DELETE FROM pronunciation WHERE LemmaID like ? AND Region like ?";
        $params = array(
            "LemmaID" => $pronunciation->lemmaID,
            "Region" => $pronunciation->region,
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
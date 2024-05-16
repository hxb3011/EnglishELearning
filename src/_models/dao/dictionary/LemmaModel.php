<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/dictionary/Lemma.php');
requirm('/dao/dictionary/MeaningModel.php');
requirm('/dao/dictionary/ConjugationModel.php');
requirm('/dao/dictionary/PronunciationModel.php');
requirm('/dao/dictionary/ContributionModel.php');

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
                    $item = [];
                    $item['key'] = $value['KeyL'];
                    $item['ID'] = $value['ID'];
                    $lemmas[] = $item;
                }
                return $lemmas;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public function get_all_lemmas(){
        // $sqlQuery = "SELECT Lemma.ID, KeyL, partOfSpeech, meaning.meaning, profile.LastName,profile.FirstName FROM lemma, meaning, contribution, profile WHERE lemma.ID = meaning.LemmaID and contribution.MeaningID = meaning.ID and profile.ID = contribution.ProfileID";
        $sqlQuery = "SELECT Lemma.ID, Lemma.KeyL, Lemma.partOfSpeech, Meaning.meaning FROM Lemma, Meaning WHERE Lemma.ID = meaning.LemmaID ";
        $params = array(
            
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            return $result;

        } catch (Exception $e) {
            return null;
        }
    }
    public function getAllFavorite(){
        $sql = "SELECT Lemma.* FROM Lemma,LearntRecord WHERE Lemma.ID = LearnRecord.LemmaID";
    }
    public function checkKeyExist($key){
        $sqlQuery = "SELECT * FROM Lemma WHERE KeyL like ?" ;
        $params = array(
            'KeyL' => $key
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if($result != null){
                return true;
            } else
                return false;

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
            return $this->get_full_data_lemma($result,true);

        } catch (Exception $e) {
            return null;
        }
    }

    public function getLemmaByPage($page)
    {
        $offset = ($page-1) * 2;
        $sqlQuery = "SELECT * FROM Lemma Limit 5 offset ?" ;
        $params = array(
            'offset' => $offset
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            return $this->get_full_data_lemma($result,false);
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
            return $this->get_full_data_lemma($result,true);
        } catch (Exception $e) {
            return null;
        }
    }

    public function getLemmaID($key){
        $sql = "SELECT ID FROM Lemma WHERE KeyL LIKE ?";
        $params = array(
            'key' => $key
        );
        try {
            $result = Database::executeQuery($sql, $params);
            foreach ($result as $index => $value) {
                return $value['ID'];
            }
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function addLemma($lemmaKey,$partOfSpeech){
        $sql = "INSERT INTO Lemma (KeyL, PartOfSpeech) VALUES (?, ?)";
        $params = array(
            "KeyL" => $lemmaKey,
            "PartOfSpeech" => $partOfSpeech,
        );
        try{
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    public function updateLemma($lemmaId, $key, $partOfSpeech){
        $sql = "UPDATE Lemma SET KeyL = ?, PartOfSpeech = ? WHERE ID = ?";
        $params = array(
            "KeyL" => $key,
            "partOfSpeech" => $partOfSpeech,
            "ID" => $lemmaId
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
    public function get_full_data_lemma($result,$single){
        $meaningModel = new MeaningModel();
        $conjugationModel = new ConjugationModel();
        $pronunciationModel = new PronunciationModel();
        $contributionModel = new ContributionModel();
        
        if ($result != null) {
            if($single == true)
            {
                foreach ($result as $index => $value) {
                    $meaning_arr = $meaningModel->getMeaningByLemmaID($value['ID']);
                    $pronunciation = $pronunciationModel->getPronunciationByLemmaID($value['ID']);
                    $conjugation = $conjugationModel->getConjugationBy_InfinitiveID($value['ID']);
                    $Lemma = new Lemma();
                    $Lemma->constructFromArray($value,$meaning_arr,$pronunciation,$conjugation);
                    return $Lemma;
                }
            } else {
                $lemmas = [];
                foreach ($result as $index => $value) {
                    $meaning_arr = $meaningModel->getMeaningByLemmaID($value['ID']);
                    $pronunciation = $pronunciationModel->getPronunciationByLemmaID($value['ID']);
                    $conjugation = $conjugationModel->getConjugationBy_InfinitiveID($value['ID']);
                    $Lemma = new Lemma();
                    $Lemma->constructFromArray($value,$meaning_arr,$pronunciation,$conjugation);
                    $lemmas[] = $Lemma;
                }
            }
            return $lemmas;
        } else {
            return null;
        }
    }
}
?>
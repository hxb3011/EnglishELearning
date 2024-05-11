<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/excerciseresponse/ExcersResponse.php');
class ExcersResponseModel
{
    // excers response
    public function getExcersResponseByExcerID($excercsieID)
    {
        $sqlQuery = "SELECT * FROM execsresponse WHERE ExcerciseID = ?";
        $params = array($excercsieID);
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $excercise = new ExcersResponse();
                foreach ($result as $index => $value) {
                    $excercise->constructFromArray($value);
                }
                return $excercise;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public function generateExcersResponseID()
    {
        $max = $this->getTotalExcersResponse();
        $max = $max + 1;
        return 'ExcersR' . $max;
    }
    public function getTotalExcersResponse()
    {
        $sqlQuery = "SELECT COUNT(*) as total_excersresponse FROM execsresponse";
        try {
            $result = Database::executeQuery($sqlQuery);
            return intval($result[0]['total_excersresponse']);
        } catch (Exception $e) {
            return false;
        }
    }
    public function addEcersResponse(ExcersResponse $excersResponse)
    {
        $sqlQuery = "INSERT INTO execsresponse(ID,AtDateTime,ExcerciseID,ProfileID) VALUES(?,STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'),?,?)";
        $params = array(
            $excersResponse->ID,
            $excersResponse->AtDateTime->format('d-m-Y H:i:s'),
            $excersResponse->ExcerciseID,
            $excersResponse->ProfileID
        );
        try {
            $result = Database::executeNonQuery($sqlQuery,$params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    // answer
    public function addAnswer(Answer $answer)
    {
        $sqlQuery = "INSERT INTO answer(Content,ExcsRespID,QuestionID) VALUES(?,?,?)";
        $params = array(
            $answer->Content,
            $answer->ExcsRespID,
            $answer->QuestionID
        );
        try{
            $result = Database::executeInsertQueryReturnID($sqlQuery,$params);
            return $result;
        }catch(Exception $e)
        {
            return null;
        }
    }
    public function getAnswerByExcsResp(int $excsrespId)
    {
        $sqlQuery = "SELECT * FROM answer WHERE ExcsRespID = ?";
        $params =array($excsrespId);
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $answers = [];
                foreach ($result as $index => $value) {
                    $answer = new Answer();
                    $answer->constructFromArray($value);
                    $answers[] = $answer;
                }
                return $answers;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    // acompmask
    public function addACompMask(ACompMask $aCompMask)
    {
        $sqlQuery = "INSERT INTO acompmask(AnswerID,QCoMaskID,Content) VALUE(?,?,?)";
        $params = array($aCompMask->AnswerID,$aCompMask->QCoMaskID,$aCompMask->Content);
        try{
            $result = Database::executeInsertQueryReturnID($sqlQuery,$params);
            return $result;
        }catch(Exception $e)
        {
            return false;
        }
    }
    public function getACompMaskByAnswer(int $answerID)
    {
        $sqlQuery = "SELECT * FROM acompmask WHERE AnswerID = ?";
        $params = array($answerID);
        try{
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $aCompMasks = [];
                foreach ($result as $index => $value) {
                    $aCompMask = new ACompMask();
                    $aCompMask->constructFromArray($value);
                    $aCompMasks[] = $aCompMask;
                }
                return $aCompMasks;
            } else {
                return array();
            }
        }catch(Exception $e)
        {
            return  array();
        }
    }

    // AMatching 
    public function addAMatching(AMatching $aMatching)
    {
        $sqlQuery = "INSERT INTO amatching(QMat,AnsID,QMatKey) VALUE(?,?,?)";
        $params = array($aMatching->QMat,$aMatching->AnsID,$aMatching->QMatKey);
        try{
            $result = Database::executeInsertQueryReturnID($sqlQuery,$params);
            return $result;
        }catch(Exception $e)
        {
            return false;
        }
    }
    public function getAMatchingsByAnswer(int $answerID)
    {
        $sqlQuery = "SELECT *FROM amatching WHERE AnsID = ?";
        $params = array($answerID);
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $amatchings = [];
                foreach ($result as $index => $value) {
                    $amatching = new AMatching();
                    $amatching->constructFromArray($value);
                    $amatchings[] = $amatching;
                }
                return $amatchings;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    //AMulchOption
    public function addAMulchOption(AMulchOption $aMulchOption)
    {
        $sqlQuery = "INSERT INTO amulchoption(QOptID,AnsID) VALUE(?,?)";
        $params = array($aMulchOption->QOptID,$aMulchOption->AnsID);
        try {
            $result = Database::executeNonQuery($sqlQuery,$params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAMulchOptionsByAnswer(int $answerID)
    {
        $sqlQuery = "SELECT *FROM amulchoption WHERE AnsID = ?";
        $params = array($answerID);
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $amulchoptions = [];
                foreach ($result as $index => $value) {
                    $amulchoption = new AMatching();
                    $amulchoption->constructFromArray($value);
                    $amulchoptions[] = $amulchoption;
                }
                return $amulchoptions;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        } 
    }
}

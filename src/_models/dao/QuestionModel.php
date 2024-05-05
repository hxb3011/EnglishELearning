<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');

class QuestionModel
{
    //Question
    public function getQuestionByExcerciseID(int $excerciseId)
    {
        $sqlQuery = "SELECT * FROM question WHERE ExcerciseID = ?";
        $params = array(
            $excerciseId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $questions = [];
                foreach ($result as $index => $value) {
                    $question = new Question();
                    $question->constructFromArray($value);
                    $questions[] = $question;
                }
                return $questions;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    public function insertQuestion(Question $question)
    {
        $sqlQuery = "INSERT INTO question(Content,State,ExcerciseID,OrderN) VALUES(?,?,?,?)";
        $params = array(
            $question->Content,
            $question->State,
            $question->ExcerciseID,
            $question->OrderN
        );
        try {
            $result = Database::executeInsertQueryReturnID($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function deleteQuestion(int $questionId)
    {
        $sqlQuery = "DELETE FROM question WHERE ID = ? ";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function updateQuestion(Question $question)
    {
        $sqlQuery = "UPDATE question SET Content = ?,State = ?,OrderN = ? WHERE ID = ?";
        $params = array(
            $question->Content,
            $question->State,
            $question->OrderN,
            $question->ID
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function getQuestionById(int $questionId)
    {
        $sqlQuery = "SELECT * FROM question WHERE ID= ?";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $question = [];
                foreach ($result as $index => $value) {
                    $question = new Question();
                    $question->constructFromArray($value);
                }
                return $question;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    //QMulchOption
    public function insertMulchQuestion(QMulchOption $question)
    {
        $sqlQuery = "INSERT INTO qmulchoption(Content,QuestionID,Correct) VALUES(?,?,?)";
        $params = array(
            $question->Content,
            $question->QuestionID,
            $question->Correct,
        );
        try {
            $result = Database::executeInsertQueryReturnID($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function deleteMulchQuestion(int $questionId)
    {
        $sqlQuery = "DELETE FROM qmulchoption WHERE ID = ? ";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function deleteMulchQuestionByQuestion(int $questionId)
    {
        $sqlQuery = "DELETE FROM qmulchoption WHERE QuestionID = ? ";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function getQMulchOptionByQuestion(int $questionId)
    {
        $sqlQuery = "SELECT * FROM qmulchoption WHERE QuestionID= ?";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $questions = [];
                foreach ($result as $index => $value) {
                    $question = new QMulchOption();
                    $question->constructFromArray($value);
                    $questions[] = $question;
                }
                return $questions;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    //QMatching & QMatchingKey
    public function insertQMatching(QMatching $question)
    {
        $sqlQuery = "INSERT INTO qmatching(Content,QuestionID,KeyQ) VALUES(?,?,?)";
        $params = array(
            $question->Content,
            $question->QuestionID,
            $question->KeyQ,
        );
        try {
            $result = Database::executeInsertQueryReturnID($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function deleteQMatching(int $questionId)
    {
        $sqlQuery = "DELETE FROM qmatching WHERE ID = ? ";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function deleteQMatchingByQuestion(int $questionId)
    {
        $sqlQuery = "DELETE FROM qmatching WHERE QuestionID = ? ";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function getQMatchingByQuestion(int $questionId)
    {
        $sqlQuery = "SELECT *  FROM qmatching WHERE QuestionID = ?";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $questions = [];
                foreach ($result as $index => $value) {
                    $question = new QMatching();
                    $question->constructFromArray($value);
                    $questions[] = $question;
                }
                return $questions;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    public function insertQMatchingKey(QMatchingKey $question)
    {
        $sqlQuery = "INSERT INTO qmatchingKey(Content) VALUES(?)";
        $params = array(
            $question->Content,
        );
        try {
            $result = Database::executeInsertQueryReturnID($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function deleteQMatchingKey(int $questionId)
    {
        $sqlQuery = "DELETE FROM qmatchingKey WHERE ID = ? ";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function getQMatchingKey(int $id)
    {
        $sqlQuery = "SELECT * FROM qmatchingkey WHERE ID = ?";
        $params= array(
            $id
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $questions = [];
                foreach ($result as $index => $value) {
                    $question = new QMatchingKey();
                    $question->constructFromArray($value);
                    $questions[] = $question;
                }
                return $questions;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    //QCompletion & QCompletionMask
    public function insertQCompletion(QCompletion $question){
        $sqlQuery = "INSERT INTO qcompletion(Content,State) VALUES(?,?)";
        $params = array(
            $question->Content,
            $question->State
        );
        try {
            $result = Database::executeInsertQueryReturnID($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function deleteQCompletion(int $questionId){
        $sqlQuery = "DELETE FROM qcompletion WHERE ID = ? ";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function getQCompletionByQuestion(int $questionId)
    {
        $sqlQuery = "SELECT *  FROM qcompletion WHERE ID = ?";
        $params = array(
            $questionId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $questions = [];
                foreach ($result as $index => $value) {
                    $question = new QCompletion();
                    $question->constructFromArray($value);
                    $questions[] = $question;
                }
                return $questions;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    public function insertQCompletionMask(QCompMask $qcomp)
    {
        $sqlQuery = "INSERT INTO qcompletionmask(Offset,Length,QCompID) VALUES(?,?,?)";
        $params = array(
            $qcomp->Offset,
            $qcomp->Length,
            $qcomp->QCompID
        );
        try {
            $result = Database::executeInsertQueryReturnID($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
    public function getQCompletionMaskByQCompletion($qcomid)
    {
        $sqlQuery = "SELECT *  FROM qcompmask WHERE QCompID = ?";
        $params = array(
            $qcomid
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $questions = [];
                foreach ($result as $index => $value) {
                    $question = new QCompMask();
                    $question->constructFromArray($value);
                    $questions[] = $question;
                }
                return $questions;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
}

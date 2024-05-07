<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Document.php');
class DocumentModel{
    public function getDocumentsByLessonID($lessonID)
    {
        $sqlQuery = "SELECT * FROM document WHERE LessonID = ?";
        $params = array(
            'lessonID' => $lessonID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $documents = [];
                foreach ($result as $index => $value) {
                    $document = new Document();
                    $document->constructFromArray($value);
                    $documents[] = $document;
                }
                return $documents;
            } else {
                return array();
            }
        } catch (Exception $e) {
            return array();
        }
    }
    public function getDocumentByID($documentID)
    {
        $sqlQuery = "SELECT * FROM document WHERE ID = ?";
        $params = array(
            'id' => $documentID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $document = new Document();
                foreach ($result as $index => $value) {
                    $document->constructFromArray($value);
                }
                return $document;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public function generateValidDocumentID()
    {
        $max = $this->getNumberOfTotalDocument();
        $max = $max + 1;
        return 'DOCUMENT' . $max;
    }
    public function getNumberOfTotalDocument()
    {
        $sqlQuery = "SELECT COUNT(*) AS total_documents FROM document";
        try {
            $result = Database::executeQuery($sqlQuery);
            return intval($result[0]['total_documents']);
        } catch (Exception $e) {
            return 0;
        }
    }
    public function getTotalDocumentInLesson($lessonId)
    {
        $sqlQuery = "SELECT COUNT(*) AS total_documents FROM document WHERE LessonID = ?";
        $params = array(
            $lessonId
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            return intval($result[0]['total_documents']);
        } catch (Exception $e) {
            return false;
        }
    }
    public function addDocument(Document $document)
    {
        $sqlQuery = "INSERT INTO document(ID,Description,DocUri,State,LessonID,OrderN,Type) VALUES(?,?,?,?,?,?,?)";
        $params = array(
            $document->ID,
            $document->Description,
            $document->DocUri,
            $document->State,
            $document->LessonID,
            $document->OrderN,
            $document->Type
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function updateDocument(Document $document)
    {
        $sqlQuery = "UPDATE document SET Description = ? ,DocUri= ? ,State= ? ,OrderN = ? ,Type = ? WHERE ID = ?";
        $params = array(
            $document->Description,
            $document->DocUri,
            $document->State,
            $document->OrderN,
            $document->Type,
            $document->ID
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function deleteDocument(string $documentId)
    {
        $sqlQuery = "DELETE FROM document WHERE ID = ? ";
        $params = array(
            $documentId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return 0;
        }
    }
    public function updateOrder(string $documentId,int $orderN)
    {
        $sqlQuery = "UPDATE document SET OrderN = ? WHERE ID = ?";
        $params = array(
            $orderN,
            $documentId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
}
<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Comment.php');
Class CommentModel{
    public function checkIDExist($id){
        $sqlQuery = "SELECT * FROM course WHERE ID=?";
        $param = array($id);
        try{
            $result = Database::executeNonQuery($sqlQuery, $param);
            if($result != null) return true;
            else    return false;
        } catch(Exception $e){
            return false;
        }
    }
    public function generateValidCommentID()
    {
        $max = $this->getNumberOfTotalComments();
        $max = $max + 1;
        while($this->checkIDExist('COMMENT'.$max)){
            $max = $max + 1;
        }
        return 'COMMENT' . $max;
    }
    public function getNumberOfTotalComments()
    {
        $sqlQuery = "SELECT COUNT(*) AS total_comments FROM comment";
        try {
            $result = Database::executeQuery($sqlQuery);
            return intval($result[0]['total_comments']);
        } catch (Exception $e) {
            return 0;
        }
    }
// Lọc comment theo bài post
    public function getCommentsByPostID(string $profileId, string $postId){
        $sqlQuery = "SELECT * FROM comment WHERE PProfId=? AND PSubID=?";
        $param = array($postId);
        try{
            $result = Database::executeQuery($sqlQuery, $param);
            if($result != null){
                $comment = new Comment();
                foreach($result as $index => $value)
                    $comment->constructFromArray($value);
                return $comment;
            }   else    return null;
            return $result;
        }
        catch(Exception $e){ 
            echo "ERROR! . $e";
            return false;
        }
        
    }
    
// Lọc comment theo người đăng comment
    public function getCommentsByAuthorId(string $profieId){
        $sqlQuery = "SELECT * FROM comment WHERE PProfId=?";
        $param = array($profieId);
        try{
            $result = Database::executeNonQuery($sqlQuery, $param);
            return $result;
        }
        catch(Exception $e){
            echo "ERROR! . $e";
            return false;
        }
    }
// Thêm comment
    public function addComment(Comment $comment ){
        $sqlQuery = "INSERT INTO comment(PProfId, PSubId, SubId, AuthID, Content, Date, Status) VALUE(?,?,?,?,?,?,?)";
        $param = array(
            "ProfileId" => $comment->PProfId,
            "PSubId" => $comment->PSubId,
            "SubId" => $comment->SubId,
            "AuthID" => $comment->AuthID,
            "Content" => $comment->content,
            "Date" => $comment->date,
            "Status" => $comment->status,
        );
        try{
            $result = Database::executeNonQuery($sqlQuery, $param);
            return $result;
        }
        catch(Exception $e){
            echo "ERROR! . $e";
            return false;
        }
    }

    /* Không thể sửa lại comment nên không có hàm update*/

// Xóa comment
    public function deleteComment(string $PProfId, int $psubId)
    {
        $sqlQuery = "DELETE FROM comment WHERE PProfId=?, PSubId=?";
        $params = array(
            $PProfId,
            $psubId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            echo "ERROR! . $e";
            return 0;
        }
    }
}
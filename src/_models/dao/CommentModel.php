<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Comment.php');
Class CommentModel{

    public function generateValidCommentID()
    {
        $max = $this->getNumberOfTotalComment();
        $max = $max + 1;
        return 'COMMENT' . $max;
    }
    public function getNumberOfTotalComment()
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
    public function getCommentsByPostID(string $postId){
        $sqlQuery = "SELECT * FROM post WHERE PSubID=?";
        $param = $postId;
        try{
            $result = Database::executeNonQuery($sqlQuery, $param);
            return $result;
        }
        catch(Exception $e){ 
            echo "ERROR! . $e";
            return false;
        }
    }
// Lọc comment theo người đăng comment
    public function getCommentsB(string $profieId){
        $sqlQuery = "SELECT * FROM post WHERE PProfileId=?";
        $param = $profieId;
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
        $sqlQuery = "INSERT INTO comment(PProfileId, PSubId, SubId, AuthID, Content, Date, Status) VALUE(?,?,?,?,?,?,?)";
        $param = array(
            "ProfileId" => $comment->PProfileId,
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
    public function deleteComment(string $pprofileId, int $psubId)
    {
        $sqlQuery = "DELETE FROM comment WHERE PProfileID=?, PSubId=?";
        $params = array(
            $pprofileId,
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
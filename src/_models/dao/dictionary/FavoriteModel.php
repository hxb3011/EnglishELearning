<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/dictionary/Favorite.php');
class FavoriteModel {

    public function isFavorite($lemmaID,$profileID){
        $sql = "SELECT EXISTS(SELECT * FROM favorite WHERE LemmaID = ? AND ProfileID like ?) as exist";
        $params = array(
            "LemmaID" => $lemmaID,
            "ProfileID" => $profileID,
        );
        try{    
            $result = Database::executeQuery($sql,$params);
            return $result;
            // if($result)
            //     return true;
            // else
            //     return false;

        } catch (Exception $e){
            return false;
        }
    }
    public function getFavoriteBy_ProfileID($ProfileID)
    {
        $sqlQuery = "SELECT * FROM Favorite WHERE ProfileID like ?";
        $params = array(
            'ProfileID' => $ProfileID,
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $Favorites = [];
                foreach ($result as $index => $value) {
                    $Favorite = new Favorite();
                    $Favorite->constructFromArray($value);
                    $Favorites[] = $Favorite;
                }
                return $Favorites;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function getFavoriteBy_LemmaID($LemmaID)
    {
        $sqlQuery = "SELECT * FROM Favorite WHERE LemmaID = ?";
        $params = array(
            'LemmaID' => $LemmaID
        );
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $Favorites = [];
                foreach ($result as $index => $value) {
                    $Favorite = new Favorite();
                    $Favorite->constructFromArray($value);
                    $Favorites[] = $Favorite;
                }
                return $Favorites;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function addFavorite($LemmaID, $profileID,$lastReviewed){
        $sql = "INSERT INTO Favorite (ProfileID, LemmaID, LastReviewed) VALUES (?, ?, ?)";
        $params = array(
            "ProfileID" => $profileID,
            "LemmaID" => $LemmaID,
            "LastReviewed" => $lastReviewed,
        );
        try{    
            $result = Database::executeNonQuery($sql,$params);
            return $result;
        } catch (Exception $e){
            return false;
        }
    }

    // public function updateFavorite(Favorite $Favorite){
    //     $sql = "UPDATE Favorite SET LastReviewed = ? WHERE ProfileID = ? AND LemmaID = ?";
    //     $params = array(
    //         "LastReviewed" => $Favorite->lastReviewed,
    //         "ProfileID" => $Favorite->profileID,
    //         "LemmaID" => $Favorite->LemmaID,
    //     );
    //     try{
    //         $result = Database::executeNonQuery($sql,$params);
    //         return $result;
    //     } catch (Exception $e){
    //         return false;
    //     }
    // }

    public function deleteFavorite($lemmaID,$profileID){
        $sql = "DELETE FROM Favorite WHERE ProfileID like ? AND LemmaID = ?";
        $params = array(
            "ProfileID" => $profileID,
            "LemmaID" => $lemmaID,
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
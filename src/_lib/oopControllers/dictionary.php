<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/access/dictionary/Meaning.php');
requirm('/access/dictionary/Lemma.php');
requirm('/access/dictionary/Example.php');
requirm('/access/dictionary/Conjugation.php');
requirm('/access/dictionary/Pronunciation.php');
requirm('/access/dictionary/Favorite.php');

requirm('/dao/dictionary/MeaningModel.php');
requirm('/dao/dictionary/LemmaModel.php');
requirm('/dao/dictionary/ExampleModel.php');
requirm('/dao/dictionary/ConjugationModel.php');
requirm('/dao/dictionary/PronunciationModel.php');
requirm('/dao/dictionary/FavoriteModel.php');

class Dictionary{
    
    public MeaningModel $meaningModel;
    public LemmaModel $lemmaModel;
    public ExampleModel $exampleModel;
    public ConjugationModel $conjugationModel;
    public PronunciationModel $pronunciationModel;
    public FavoriteModel $favoriteModel;
    
    public function __construct(){
        $this->meaningModel = new MeaningModel();
        $this->lemmaModel = new LemmaModel();
        $this->exampleModel = new ExampleModel();
        $this->conjugationModel = new ConjugationModel();
        $this->pronunciationModel = new PronunciationModel();
        $this->favoriteModel = new FavoriteModel();
    }
    // Hiển thị view
    public function dictionary()
    {
        requirv("dictionary/dictionary.php");
        global $page;
        $page = new DictionaryMainPage();
        requira("_layout.php");
    }
    public function detail($profileID)
    {
        requirv("dictionary/dictionary.php");
        $word = $_REQUEST['dictionary_search'];
        $lemma = $this->lemmaModel->getLemmaByKeyL($word);
        if($lemma)
        {
            $conjugation = $this->conjugationModel->getConjugationBy_InfinitiveID($lemma->ID);
            $alternative = [];
            if($conjugation)
            foreach($conjugation as $item){
                $alterLemma = new Lemma();
                $alterLemma = $this->lemmaModel->getLemmaByID($item->alternativeID);
                $lemma_conjugation_group = [];
                $lemma_conjugation_group['lemma'] = $alterLemma;
                $lemma_conjugation_group['description'] = $item->description;
                $alternative[] = $lemma_conjugation_group;
            }
            $favorite = $this->favoriteModel->isFavorite($lemma->ID,$profileID);
            if($favorite){
                if($favorite[0]['exist'] == 1){
                    $lemma->favorite = true;
                    echo "<script> console.log('true')</script>";}
                else   {
                    $lemma->favorite = false;
                    echo "<script> console.log('false')</script>";}
            }

        global $page;    
        $page = new DictionaryMainPage();
        $page->detail_contruct($lemma,$alternative,);
        requira("_layout.php");
        } else {
            echo "<script> alert('Word not found')</script>";
            global $page;
            $page = new DictionaryMainPage($word);
            requira("_layout.php");
        }
        
    }
    public function favorite($profileID)
    {
        requirv("dictionary/favorite.php");
        global $page;
        $page = new DictionaryFavoritePage();
        if($profileID != null){
            $page->lemma_arr = $this->lemmaModel->getAllFavorite($profileID);
        }
        requira('_layout.php');
    }
    
    public function update_favorite($profileID)
    {
        $response = array();
        $jsonData = "";
        if(!empty($_REQUEST["lemmaID"]) && $profileID != null){
            $lemmaID = $_REQUEST["lemmaID"];
            if(strcasecmp($_REQUEST["type"],"add") == 0){
                $result = $this->favoriteModel->addFavorite($lemmaID,$profileID,null);
                if($result){
                    $response['status'] = '204';
                    $response['message'] = 'Thêm thành công';
                }else{
                    $response['status'] = '404';
                    $response['message'] = 'Cập nhật thất bại, Profile ID: '.$profileID;
                }
            }
            else{
                $result = $this->favoriteModel->deleteFavorite($lemmaID,$profileID);
                if($result){
                    $response['status'] = '204';
                    $response['message'] = 'Xóa thành công';
                }else{
                    $response['status'] = '304';
                    $response['message'] = 'Xóa thất bại, Profile ID: '.$profileID;
                }
            }
        }
        else{
            $response['status'] = '404';
            $response['message'] = 'Cập nhật thất bại, Profile ID: '.$profileID;
            
        }
        $jsonData = json_encode($response);
        echo $jsonData;
    }
    public function favoriteDetail(){
        $response = array();
        $jsonData = "";
        $lemmaID = $_REQUEST['lemmaID'];
        $lemma = $this->lemmaModel->getLemmaByID($lemmaID);
        if($lemma){
            $response['data'] = $lemma;
            $jsonData = json_encode($response);
            echo $jsonData;
        }
    }
    public function search(){
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['search_input'])) {
            $key = $_REQUEST['search_input'];
            $key_arr = [];
            $key_arr = $this->lemmaModel->liveSearch($key);
            
            if($key_arr){
                $response['status'] = '204';
                $response['items'] = $key_arr;
                $jsonData = json_encode($response);
                echo $jsonData;
            }
            else{
                $response['status'] = '404';
                // $response['message'] = 'Thêm thất bại';
                $jsonData = json_encode($response);
                echo $jsonData;
            }
        }
    }
}
?>
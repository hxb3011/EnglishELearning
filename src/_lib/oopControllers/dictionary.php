<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/access/dictionary/Meaning.php');
requirm('/access/dictionary/Lemma.php');
requirm('/access/dictionary/Example.php');
requirm('/access/dictionary/Conjugation.php');
requirm('/access/dictionary/Pronunciation.php');
requirm('/access/dictionary/LearntRecord.php');

requirm('/dao/dictionary/LearntRecordModel.php');
requirm('/dao/dictionary/MeaningModel.php');
requirm('/dao/dictionary/LemmaModel.php');
requirm('/dao/dictionary/ExampleModel.php');
requirm('/dao/dictionary/ConjugationModel.php');
requirm('/dao/dictionary/PronunciationModel.php');

class Dictionary{
    
    public MeaningModel $meaningModel;
    public LemmaModel $lemmaModel;
    public ExampleModel $exampleModel;
    public ConjugationModel $conjugationModel;
    public PronunciationModel $pronunciationModel;
    
    public function __construct(){
        $this->meaningModel = new MeaningModel();
        $this->lemmaModel = new LemmaModel();
        $this->exampleModel = new ExampleModel();
        $this->conjugationModel = new ConjugationModel();
        $this->pronunciationModel = new PronunciationModel();
    }
    // Hiển thị view
    public function dictionary()
    {
        requirv("dictionary/dictionary.php");
        global $page;
        $page = new DictionaryMainPage();
        requira("_layout.php");
    }
    public function favorite()
    {
        requirv("dictionary/favorite.php");
        global $page;
        $page = new DictionaryFavoritePage();
        requira("_layout.php");
    }
    public function detail($word)
    {
        requirv("dictionary/dictionary.php");
        $lemma = $this->lemmaModel->getLemmaByKeyL($word);
        if($lemma)
        {
            $conjugation = $this->conjugationModel->getConjugationBy_InfinitiveID($lemma->ID);
            $alternative = [];
            foreach($conjugation as $item){
                $alterLemma = new Lemma();
                $alterLemma = $this->lemmaModel->getLemmaByID($item->alternativeID);
                $lemma_conjugation_group = [];
                $lemma_conjugation_group['lemma'] = $alterLemma;
                $lemma_conjugation_group['description'] = $item->description;
                $alternative[] = $lemma_conjugation_group;
            }

        global $page;    
        $page = new DictionaryMainPage();
        $page->detail_contruct($lemma,$alternative);
        requira("_layout.php");
        } else {
            echo "<script> alert('Word not found')</script>";
            global $page;
            $page = new DictionaryMainPage($word);
            requira("_layout.php");
        }
        
    }
    public function getFavorite(){
        requirv("dictionary/favorite.php");
        $page = new DictionaryFavoritePage();
        $page->lemma_arr = $this->lemmaModel->getAllFavorite();
    }
    public function add_favorite()
    {
        // $lemmaID = $_POST[]
        // $this->LearntRecordModel->add_learntRecord()
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
                // $response['message'] = 'Không truyền thông tin của khóa học hoặc bài học cần xóa';
                $jsonData = json_encode($response);
                echo $jsonData;
            }
        }
    }
}
?>
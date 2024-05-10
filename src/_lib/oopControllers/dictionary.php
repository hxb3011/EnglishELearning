<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/access/dictionary/Meaning.php');
requirm('/access/dictionary/Lemma.php');
requirm('/access/dictionary/Example.php');
requirm('/access/dictionary/Conjugation.php');
requirm('/access/dictionary/Pronunciation.php');

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
            $meaning = $this->meaningModel->getMeaningByLemmaID($lemma->ID);
            $example = $this->exampleModel->getExampleByMeaningID($meaning[0]->ID);
            $pronunciation = $this->pronunciationModel->getPronunciationByLemmaID($lemma->ID);
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
        $page->detail_contruct($lemma,$meaning,$example,$alternative,$pronunciation);
        requira("_layout.php");
        } else {
            $this->word_not_found();
            echo "<script> alert('Word not found')</script>";
        // global $page;
        // $page = new DictionaryMainPage($word);
        // requira("_layout.php");
        }
        
    }
    public function word_not_found(){
        echo "Not found word";
    }

    public function search($input){
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['input'])) {
            $key = $_REQUEST['input'];
            $lemma_arr = [];
            $lemma_arr = $this->lemmaModel->liveSearch($key);
            
            if($lemma_arr){
                $items = [];
                $item = [];
                $response['status'] = '204';
                foreach($lemma_arr as $lemma )
                {
                    $item['ID'] = $lemma->ID;
                    $item['KeyL'] = $lemma->keyL;
                    $items[] = $item;
                }
                $response['items'] = $items;
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
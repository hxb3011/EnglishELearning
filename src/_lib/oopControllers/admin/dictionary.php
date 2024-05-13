<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/access/dictionary/Meaning.php');
requirm('/access/dictionary/Lemma.php');
requirm('/access/dictionary/Example.php');
requirm('/access/dictionary/Conjugation.php');
requirm('/access/dictionary/Pronunciation.php');
requirm('/access/dictionary/Contribution.php');

requirm('/dao/dictionary/MeaningModel.php');
requirm('/dao/dictionary/LemmaModel.php');
requirm('/dao/dictionary/ExampleModel.php');
requirm('/dao/dictionary/ConjugationModel.php');
requirm('/dao/dictionary/PronunciationModel.php');
requirm('/dao/dictionary/ContributionModel.php');


requirl('/services/S3Service.php');

class AdminDictionary
{
    
    public MeaningModel $meaningModel;
    public LemmaModel $lemmaModel;
    public ExampleModel $exampleModel;
    public ConjugationModel $conjugationModel;
    public PronunciationModel $pronunciationModel;
    public ContributionModel $contributionModel;
    
    public function __construct()
    {
        $this->meaningModel = new MeaningModel();
        $this->lemmaModel = new LemmaModel();
        $this->exampleModel = new ExampleModel();
        $this->conjugationModel = new ConjugationModel();
        $this->pronunciationModel = new PronunciationModel();
        $this->contributionModel = new ContributionModel();
    }
    /* trả về view  */
    public function index()
    {
        requirv("admin/dictionary/ManageDictionary.php");
        global $page;
        $page = new ManageDictionaryPage();
        $page->words = $this->get_all_words();
        requira("_adminLayout.php");
    }
    public function edit($lemmaID){
        requirv("admin/dictionary/EditWordPage.php");
        global $page;
        $page = new EditWordPage();
        $page->lemma = $this->lemmaModel->getLemmaByID($lemmaID);
        $conjugation = $this->conjugationModel->getConjugationBy_InfinitiveID($page->lemma->ID);
        $alternative = [];
        foreach($conjugation as $item){
            $alterLemma = new Lemma();
            $alterLemma = $this->lemmaModel->getLemmaByID($item->alternativeID);
            $lemma_conjugation_group = [];
            $lemma_conjugation_group['lemma'] = $alterLemma;
            $lemma_conjugation_group['description'] = $item->description;
            $alternative[] = $lemma_conjugation_group;
        }
        requira("_adminLayout.php");
    }
    public function add(){
        requirv("admin/dictionary/AddWordPage.php");
        global $page;
        $page = new AddWordPage();
        requira("_adminLayout.php");
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
    public function checkKeyExist(){
        $response = array();
        $jsonData = "";
        if(isset($_REQUEST['input'])){
            $key = $_REQUEST['input'];
            $result = $this->lemmaModel->checkKeyExist($key);
            if($result == true){
                $response['status'] = '204';
            } else{
                $response['status'] = '404';
            }
            $jsonData = json_encode($response);
            echo $jsonData;
        }
    }
    public function get_all_words(){
        $words = [];
        $lemmas = $this->lemmaModel->getLemmaByPage(1);
        if($lemmas)
            foreach($lemmas as $lemma){
                //mỗi $word bao gồm lemma và mảng meaning
                $word = [];
                $meanings = [];
                $word['lemma']['ID'] = $lemma->ID;
                $word['lemma']['keyL'] = $lemma->keyL;
                $word['lemma']['partOfSpeech'] = $lemma->partOfSpeech;

                if($lemma->meaning_arr)
                    foreach (($lemma->meaning_arr) as $v){
                        $meanings[] = $v->meaning;
                    }
                $word['meaning'] = $meanings;

                $contribution = $this->contributionModel->getContributionBy_LemmaID($lemma->ID);
                // $profile = $this->profileModel->getProfileByID($contribution->profileID);
                if($contribution){
                    $word['contributor'] = $contribution->profileID;
                    $word['state'] = $contribution->accepted;
                }
                $words[] = $word;
            }
        return $words;
    }
    public function editLemma(){
        try{
            $lemmaID = $_POST['lemmaID'];
            $lemmaKey = $_POST['lemmaKey'];
            $partOfSpeech = $_POST['partOfSpeech'];
            $infinitiveID = $_POST['infinitiveID'];
            $IPAUS = $_POST['IPAUS'];
            $IPAUK = $_POST['IPAUK'];
            $result = $this->lemmaModel->updateLemma($lemmaID,$lemmaKey,$partOfSpeech);
            if ($result >= 1) {
                $result = $this->pronunciationModel->updatePronunciation($lemmaID,'US',$IPAUS);
                $result = $this->pronunciationModel->updatePronunciation($lemmaID,'UK',$IPAUK);
                if($result >= 1 && !empty($infinitiveID)){
                    // $result = $this->conjugationModel->updateConjugation($infinitiveID,$alternativeID,$description);
                    $redirect = "Location: /administration/dictionary/edit.php?lemmaID=" . $lemmaID;
                    header($redirect);
                    exit;
                }
                $redirect = "Location: /administration/dictionary/edit.php?lemmaID=" . $lemmaID;
                header($redirect);
                exit;
            }
            $redirect = "Location: /administration/dictionary/edit.php?lemmaID=" . $lemmaID;
            header($redirect);
            exit;
        } catch (Exception $e){
            echo $e;
        }
    }
    public function addLemma(){
        try{
            $lemmaKey = $_POST['lemmaKey'];
            $partOfSpeech = $_POST['partOfSpeech'];
            $infinitiveID = $_POST['infinitiveID'];
            $description = $_POST['description'];
            $region = $_POST['region'];
            $IPA = $_POST['IPA'];
            $result = $this->lemmaModel->addLemma($lemmaKey,$partOfSpeech);
            if ($result >= 1) {
                $lemmaID = $this->lemmaModel->getLemmaID($lemmaKey);
                $result = $this->pronunciationModel->addPronunciation($lemmaID,$region,$IPA);
                if($result >= 1 && !empty($infinitiveID)){
                    $result = $this->conjugationModel->addConjugation($infinitiveID,$alternativeID,$description);
                    if($result >= 1){
                        $redirect = "Location: /administration/dictionary/dictionary.php";
                        header($redirect);
                        exit;
                    }
                }
                $redirect = "Location: /administration/dictionary/dictionary.php";
                header($redirect);
                exit;
            }
        } catch (Exception $e){
            echo $e;
        }
    }
    //Hiển thị modal
    public function meaning_modal()
    {
        global $editMode;
        global $lemma;
        global $meaning;
        $editMode = isset($_REQUEST['editmode']);
        // thêm bài giảng
        if (!$editMode) {
            if (isset($_REQUEST['lemmaID'])) {
                $lemma = $this->lemmaModel->getLemmaByID($_REQUEST['lemmaID']);
                requirv("admin/dictionary/modal/meaning.php");
            } else {
                header('Location: /error');
            }
        } else {
            // Sửa bài giảng
            if (isset($_REQUEST['meaningID'])) {
                $meaning = $this->meaningModel->getMeaningByID($_REQUEST['meaningID']);
                $lemma = $this->lemmaModel->getLemmaByID($meaning->lemmaID);
                requirv("admin/dictionary/modal/meaning.php");
            } else {
                header('Location: /error');
            }
        }
    }
    public function example_modal()
    {
        global $editMode;
        global $meaning;
        global $example;
        $editMode = isset($_REQUEST['editmode']);
        //Thêm ví dụ
        if (!$editMode) {
            if (isset($_REQUEST['meaningID'])) {
                $meaning = $this->meaningModel->getmeaningByID($_REQUEST['meaningID']);
                requirv("admin/dictionary/modal/example.php");
            } else {
                header('Location: /error');
            }
        }
        //Sửa ví dụ
        else{
            if (isset($_REQUEST['exampleID'])) {
                $meaning = $this->meaningModel->getmeaningByID($_REQUEST['meaningID']);
                $example = $this->exampleModel->getExampleByID($_REQUEST['exampleID']);
                requirv("admin/dictionary/modal/example.php");
            } else {
                header('Location: /error');
            }
        }
    }
    public function add_meaning(){
        try {
            $meaning = new Meaning();
            $meaning->ID = $this->meaningModel->generateValidMeaningID();
            $meaning->lemmaID = $_POST['lemma_ID'];
            $meaning->meaning = $_POST['meaning_key'];
            $meaning->explanation = $_POST['meaning_explanation'];
            $meaning->note = $_POST['meaning_note'];
            $meaning->levelV = "";
            $result = $this->meaningModel->addMeaning($meaning);
            if ($result >= 1) {
                $redirect = "Location: /administration/dictionary/edit.php?lemmaID=" . $meaning->lemmaID;
                header($redirect);
                exit;
            }
        } catch (Exception $ex) {
            echo $ex;
        }
    }
    public function update_meaning(){
        try {
            $meaning = new Meaning();
            $meaning->ID = $_POST['meaning_ID'];
            $meaning->lemmaID = $_POST['lemma_ID'];
            $meaning->meaning = $_POST['meaning_key'];
            $meaning->explanation = $_POST['meaning_explanation'];
            $meaning->note = $_POST['meaning_note'];
            $meaning->levelV = "";
            $result = $this->meaningModel->updateMeaning($meaning);
            if ($result >= 1) {
                $redirect = "Location: /administration/dictionary/edit.php?lemmaID=" . $meaning->lemmaID;
                header($redirect);
                exit;
            }
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public function delete_meaning(){
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['meaning_ID'])) {
            $meaning = $this->meaningModel->getMeaningByID($_REQUEST['meaning_ID']);
            if($meaning){
                $delete_example_folder = $this->exampleModel->deleteExamplesBy_MeaningID($meaning->ID);
                if(isset($delete_example_folder) && $delete_example_folder > 0)
                    $result = $this->meaningModel->deleteMeaning($meaning);
            }
        }
        if (isset($result) && $result > 0) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
        } else {
            $response['status'] = '404';
            $response['message'] = 'Không xóa được';
        }

        $jsonData = json_encode($response);
        echo $jsonData;
    }

    public function add_example(){
        try {
            $example = new Example();
            $example->meaningID = $_POST['meaning_ID'];
            $example->example = $_POST['example_key'];
            $example->explanation = $_POST['example_explanation'];
            $result = $this->exampleModel->addExample($example);
            if ($result >= 1) {
                $redirect = "Location: /administration/dictionary/edit.php?lemmaID=" . $_POST['lemma_ID'];
                header($redirect);
                exit;
            }
        } catch (Exception $ex) {
            echo $ex;
        }
    }
    public function update_example(){
        try {
            $example = new Example();
            $example->ID = $_POST['example_ID'];
            $example->meaningID = $_POST['meaning_ID'];
            $example->example = $_POST['example_key'];
            $example->explanation = $_POST['example_explanation'];
            $result = $this->exampleModel->updateExample($example);
            if ($result >= 1) {
                $redirect = "Location: /administration/dictionary/edit.php?lemmaID=" . $_POST['lemma_ID'];
                header($redirect);
                exit;
            }
        } catch (Exception $ex) {
            echo $ex;
        }
    }
    
    public function delete_example(){
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['example_ID'])) {
            $example = $this->exampleModel->getExampleByID($_REQUEST['example_ID']);
            if($example)
                $result = $this->exampleModel->deleteExample($example);
        }
        if (isset($result) && $result > 0) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
        } else {
            $response['status'] = '404';
            $response['message'] = 'Không xóa được';
        }

        $jsonData = json_encode($response);
        echo $jsonData;
    }
    
    public function update_lesson()
    {
        try {
            $lesson = new Lesson();
            $lesson->ID = $_POST['lesson_id'];
            $lesson->Description = $_POST['lesson_desc'];
            $lesson->State = $_POST['lesson_state'];
            $lesson->CourseID = $_POST['course_id'];
            $result = $this->lessonModel->updateLesson($lesson);
            if ($result >= 1) {
                $redirect = "Location: /administration/courses/edit.php?courseId=" . $lesson->CourseID;
                header($redirect);
                exit;
            }
        } catch (Exception $ex) {
        }
    }
    public function delete_lesson()
    {
        //
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['lessonId'])) {
            $lesson = $this->lessonModel->getLessonById($_REQUEST['lessonId']);
            $deleteLessonTextFolder = $this->s3Service->deleteFileInFolder('private/text/' . $lesson->CourseID . '/' . $lesson->ID . '/');
            $deleteLessonVideoFolder = $this->s3Service->deleteFileInFolder('private/video/' . $lesson->CourseID . '/' . $lesson->ID . '/');

            $result = $this->lessonModel->deleteLesson($lesson->ID);
        }
        if (isset($result) && $result > 0) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
        } else {
            $response['status'] = '404';
            $response['message'] = 'Không xóa được';
        }

        $jsonData = json_encode($response);
        echo $jsonData;
    }
}
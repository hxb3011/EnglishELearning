<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/access/dictionary/Meaning.php');
requirm('/access/dictionary/Lemma.php');
requirm('/access/dictionary/Example.php');
requirm('/access/dictionary/Conjugation.php');
requirm('/access/dictionary/Pronunciation.php');
requirm('/access/dictionary/Contribution.php');
requirm('/dao/profile/profile.php');

requirm('/dao/dictionary/MeaningModel.php');
requirm('/dao/dictionary/LemmaModel.php');
requirm('/dao/dictionary/ExampleModel.php');
requirm('/dao/dictionary/ConjugationModel.php');
requirm('/dao/dictionary/PronunciationModel.php');
requirm('/dao/dictionary/ContributionModel.php');

requirl("profile/permissionChecker.php");
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
        // $page->tutors = ProfileDAO::getProfileByType(0);
        requira("_adminLayout.php");
    }
    public function edit($lemmaID){
        requirv("admin/dictionary/EditWordPage.php");
        global $page;
        $page = new EditWordPage();
        $page->lemma = $this->lemmaModel->getLemmaByID($lemmaID);
        $conjugation = $this->conjugationModel->getConjugationBy_InfinitiveID($page->lemma->ID);
        $alternative = [];
        // foreach($conjugation as $item){
        //     $alterLemma = new Lemma();
        //     $alterLemma = $this->lemmaModel->getLemmaByID($item->alternativeID);
        //     $lemma_conjugation_group = [];
        //     $lemma_conjugation_group['lemma'] = $alterLemma;
        //     $lemma_conjugation_group['description'] = $item->description;
        //     $alternative[] = $lemma_conjugation_group;
        // }
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
    public function get_all()
    {
        $arr = array();
        $arr['data'] = $this->lemmaModel->get_all_lemmas();
        echo json_encode($arr);
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

                // $contribution = $this->contributionModel->getContributionBy_LemmaID($lemma->ID);
                // $profile = $this->profileModel->getProfileByID($contribution->profileID);q
                // if($contribution){
                    // $word['contributor'] = $contribution->profileID;
                    // $word['state'] = $contribution->accepted;
                // }
                $words[] = $word;
            }
        return $words;
    }

    public function editLemma(){
        $holder = getPermissionHolder();
        $granted = false;
        if (isset($holder)) {
            if (isAllPermissionsGranted([Permission_LemmaWrite],$holder)) {
                $granted = true;
            }
        }
        if (!$granted) {
            http_response_code(403);
            $_REQUEST["ersp"] = "403";
            requira("_error.php");
            return;
        }
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
            $IPAUS = $_POST['IPAUS'];
            $IPAUK = $_POST['IPAUK'];
            $result = $this->lemmaModel->addLemma($lemmaKey,$partOfSpeech);
            if ($result >= 1) {
                $lemmaID = $this->lemmaModel->getLemmaID($lemmaKey);
                $result = $this->pronunciationModel->addPronunciation($lemmaID,'US',$IPAUS);
                $result = $this->pronunciationModel->addPronunciation($lemmaID,'UK',$IPAUK);
                if($result >= 1 && !empty($infinitiveID)){
                    $result = $this->conjugationModel->addConjugation($infinitiveID,$lemmaID,$description);
                    $result = $this->conjugationModel->addConjugation($lemmaID,$infinitiveID,$description);
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
    public function delete_Lemma(){
        $holder = getPermissionHolder();
        $granted = false;
        if (isset($holder)) {
            if (isAllPermissionsGranted([Permission_DictionaryManage],$holder)) {
                $granted = true;
            }
        }
        if (!$granted) {
            http_response_code(403);
            $_REQUEST["ersp"] = "403";
            requira("_error.php");
            return;
        }
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['lemmaID'])) { 
            $lemmaID = $_REQUEST['lemmaID'];
            $checkMeaning = $this->meaningModel->meaningExist($lemmaID);
            $meaning = $this->meaningModel->getMeaningByLemmaID($lemmaID);
            $checkExample = $this->exampleModel->exampleExist($meaning->ID);  
            echo $checkMeaning;
            echo $checkExample;
            // $result = $this->courseModel->deleteCourse($lemmaID);
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
        $holder = getPermissionHolder();
        $granted = false;
        if (isset($holder)) {
            if (isAllPermissionsGranted([Permission_MeaningRead],$holder)) {
                $granted = true;
            }
        }
        if (!$granted) {
            http_response_code(403);
            $_REQUEST["ersp"] = "403";
            requira("_error.php");
            return;
        }
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
        $holder = getPermissionHolder();
        $granted = false;
        if (isset($holder)) {
            if (isAllPermissionsGranted([Permission_MeaningWrite],$holder)) {
                $granted = true;
            }
        }
        if (!$granted) {
            http_response_code(403);
            $_REQUEST["ersp"] = "403";
            requira("_error.php");
            return;
        }
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
        $holder = getPermissionHolder();
        $granted = false;
        if (isset($holder)) {
            if (isAllPermissionsGranted([Permission_MeaningRead],$holder)) {
                $granted = true;
            }
        }
        if (!$granted) {
            http_response_code(403);
            $_REQUEST["ersp"] = "403";
            requira("_error.php");
            return;
        }
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
        $holder = getPermissionHolder();
        $granted = false;
        if (isset($holder)) {
            if (isAllPermissionsGranted([Permission_ExampleWrite],$holder)) {
                $granted = true;
            }
        }
        if (!$granted) {
            http_response_code(403);
            $_REQUEST["ersp"] = "403";
            requira("_error.php");
            return;
        }
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
        $holder = getPermissionHolder();
        $granted = false;
        if (isset($holder)) {
            if (isAllPermissionsGranted([Permission_ExampleWrite],$holder)) {
                $granted = true;
            }
        }
        if (!$granted) {
            http_response_code(403);
            $_REQUEST["ersp"] = "403";
            requira("_error.php");
            return;
        }
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
        // $holder = getPermissionHolder();
        // $granted = false;
        // if (isset($holder)) {
        //     if (isAllPermissionsGranted([Permission_DictionaryManage],$holder)) {
        //         $granted = true;
        //     }
        // }
        // if (!$granted) {
        //     http_response_code(403);
        //     $_REQUEST["ersp"] = "403";
        //     requira("_error.php");
        //     return;
        // }
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
}
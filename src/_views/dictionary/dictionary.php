<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm('/access/dictionary/Meaning.php');
requirm('/access/dictionary/Lemma.php');
requirm('/access/dictionary/Example.php');
requirm('/access/dictionary/Conjugation.php');
requirm('/access/dictionary/Pronunciation.php');

final class DictionaryMainPage extends BaseHTMLDocumentPage
{
    public Lemma $lemma;
    public $conjugation_arr = array();
    public $example_arr = array();
    public function __construct()
    {
        parent::__construct();

    }
    public function detail_contruct($lemma,$conjugation)
    {
        $this->lemma = $lemma;
        $this->conjugation_arr = $conjugation;

    }
    
    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Từ điển - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Từ điển - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }
    public function head()
    {
        $this->style(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css",
            "sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        );
        $this->script(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",
            "sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        );
        $this->styles(
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css",
            "/clients/css/dictionary/dictionary-main.css",
            "/clients/css/home/home_main.css",
            "/clients/css/header/header.css",
            "/clients/css/footer/footer.css"
        );
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js",
            "/clients/js/autocomplete.js",

        );
        // $this->scripts(
    }
    public function body()
    {
        ?>
        <div class="container my-5 mx-0" >
            <div class="section-heading xx-large mtop-5">find a word</div>
            <div class="margin-5 w-100">
                <form class="form-inline d-flex form-search  mx-auto" method= "get" action="all.php" name="dictionary_search" autocomplete="off">
                <div class="autocomplete w-100">
                    <input class="form-control border border-dark mr-sm-2 search_bar" id="inp_search" type="search" name="dictionary_search" placeholder=" Search..." aria-label="Search">
                    <input type="hidden" id="inp_save">
                </div>
                <button class="btn btn-dark my-2 my-sm-0 rounded-0 rounded-end search_button" type="submit">
                    <i class="fas fa-search icon_search"></i>
                </button>
                </form>
            </div>
            <?php
            if(isset($this->lemma)){
                echo 
                '<div class="word-detail ">
                <div class="card  padding-5">
                    <h3 class="part-of-speech ">'. $this->lemma->partOfSpeech.'</h3>
                    <div class="title_n_heart">
                        <h3 class="word_title text-reset">'. $this->lemma->keyL.'</h3>
                        <a class="mdi-b heart-icon -dictionary " hint="Yêu thích" href="#"></a>
                    </div>
                    <span class="word_pronunciation ">';
                    foreach(($this->lemma->pronunciation_arr) as $item)
                        echo ' <p class="  text-reset opacity-75 " >  <strong> '. $item->region .'</strong>: '.$item->IPA. '  &nbsp;&nbsp;&nbsp;&nbsp;</p>';
                    echo '</span>';
                    foreach(($this->lemma->meaning_arr) as $item){
                        echo '<p class="word_definition text-reset" align ="jusitify"> '.$item->meaning .' </p>';
                        echo '<p class="word_definition text-reset" align ="jusitify"> '.$item->explanation .' </p>';

                        echo '<i class="example " align ="jusitify">Example:</i>';
                        foreach(($item->example_arr) as $example)  {
                            echo '<i class="example " align ="jusitify">'.$example->example .'</i>';
                            echo '<i class="example " align ="jusitify">'.$example->explanation .'</i>';}
                    }

                    echo '<p class="conjugation " align ="jusitify">';
                    $firstPrint = true;
                    foreach(($this->conjugation_arr) as  $item)  {
                        if($firstPrint){
                            echo $item['description'].' <a href="http://localhost:62280/dictionary/all.php?dictionary_search='.$item['lemma']->keyL.'">'.$item['lemma']->keyL.'</a>  ';
                            $firstPrint = false;
                        } else
                            echo ' | '.$item['description'].' <a href="http://localhost:62280/dictionary/all.php?dictionary_search='.$item['lemma']->keyL.'">'.$item['lemma']->keyL.'</a>  ';}
                    echo '</p> 
                </div>
                </div>';
            }
            ?>
        </div>
        <script defer>
        
        var currentFocus = -1;
        autocomplete(document.getElementById("inp_search"),"inp_save",'ajax_call_action.php?action=search');
        
        // Hết phần autocomplete    
        </script>
    <?}
}
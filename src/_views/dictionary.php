<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class DictionaryMainPage extends BaseHTMLDocumentPage
{
    public function __construct()
    {
        parent::__construct();
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
        $this->styles(
            "/clients/css/dictionary/dictionary.css"
        );
        // $this->scripts(

        // );
    }

    public function body()
    {
        ?>
        <div class="container mt-5 mb-5" >
            <div class="section-heading section-heading--lg ">Dictionary</div>
            <div class = "container flashcard__container">
                <div class="row mt-5 justify-content-center">
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-3 my-3">
                        <div class="card text-bg-dark text-light rounded-5 p-5">
                            <h3 class="pretitle text-end ">Noun</h3>
                            <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
                            <h3 class="card-title word_title text-reset">Coffee</h3>
                            <p class="word_pronouce  text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them</p>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-3 my-3">
                        <div class="card text-bg-dark text-light rounded-5 p-5">
                            <h3 class="pretitle text-end ">Noun</h3>
                            <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
                            <h3 class="card-title word_title text-reset">Coffee</h3>
                            <p class="word_pronouce  text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them</p>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-3 my-3">
                        <div class="card text-bg-dark text-light rounded-5 p-5">
                            <h3 class="pretitle text-end ">Noun</h3>
                            <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
                            <h3 class="card-title word_title text-reset">Coffee</h3>
                            <p class="word_pronouce  text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them</p>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-3 my-3">
                        <div class="card text-bg-dark text-light rounded-5  p-5">
                            <h3 class="pretitle text-end ">Noun</h3>
                            <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
                            <h3 class="card-title word_title text-reset">coffee</h3>
                            <p class="word_pronouce  text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition  text-reset " align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them</p>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-3 my-3">
                        <div class="card text-bg-dark text-light rounded-5 p-5">
                            <h3 class="pretitle text-end ">Adverb</h3>
                            <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
                            <h3 class="card-title word_title text-reset">exponentially</h3>
                            <p class="word_pronouce  text-reset opacity-75 "> /ˌek.spoʊˈnen.ʃəl.i/</p>
                            <p class="word_definition text-reset" align ="jusitify"> in a way that becomes quicker and quicker as something that increases becomes larger</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>
<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class DictionaryFavoritePage extends BaseHTMLDocumentPage
{
    public $lemma_arr = array();
    public function __construct()
    {
        parent::__construct(NAV_DICT_REVIEW);
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
        parent::favIcon("/assets/images/logo-icon.png", $svg);
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
            "/clients/css/dictionary/dictionary-favorite.css",
            "/clients/css/admin/autocomplete.css",
            "/clients/css/home/home_main.css",
            "/clients/css/header/header.css",
            "/clients/css/footer/footer.css"
        );
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "/clients/js/autocomplete.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        );
        // $this->scripts(
    }
    public function body()
    {
        ?>
        <? if(isset($this->lemma_arr)) : ?>
        
        <div class="word-detail _closed">
            <div class="card round-5 padding-5">    
                <h3 class="part-of-speech "> </h3>
                <div class="title_n_heart">
                    <h3 class="word_title text-reset">Coffee</h3>
                    <a class="mdi-b heart-icon " hint="Yêu thích" href="#"></a>
                </div>
                <p class="word_pronunciation  text-reset opacity-75 ">/ˈkɒfi/</p>
                <p class="word_definition text-reset" align ="jusitify"> a dark brown powder with a strong flavour and smell that is made by crushing dark beans from a tropical bush and used to make a drink </p>
                <i class="example " align ="jusitify">Example:</i>
                <p class="conjugation " align ="jusitify">present participle <a href="#">running</a> | past tense <a href="#">ran</a> | past participle <a href="#">run</a></p>
            </div>
        </div>
        <div class="container my-5 mx-0" >
            <div class="section-heading xx-large mtop-5">Favorite</div>
            <div class = " flashcard__container mtop-5">
                <div class="margin-5">
                    <form class="form-inline d-flex width-search round-5 mx-auto" autocomplete="off">
                    <div class="autocomplete w-100">
                        <input class="form-control border border-dark mr-sm-2 search_bar" id="inp_search" type="search" placeholder=" Search..." aria-label="Search">
                    </div>
                    <button class="btn btn-dark my-2 my-sm-0 rounded-0 rounded-end search_button" type="submit">
                        <i class="fas fa-search icon_search"></i>
                    </button>
                    </form>
                </div>
                <div class="row mt-5 justify-content-center mx-auto">
                <? foreach (($this->lemma_arr) as $lemma) : ?>
                    <div class=" col col-sm-2  margin-5" onclick="showDetail('<? echo $lemma->ID ?>')">
                        <div class="card  round-5 padding-5" >
                            <h3 class="part-of-speech "><? echo $lemma->partOfSpeech ?></h3>
                            <div class="title_n_heart">
                                <h3 class=" word_title text-reset"><? echo $lemma->keyL ?></h3>
                                <a class="mdi-b heart-icon  _selected" hint="Yêu thích" href="#"></a>
                            </div>
                            <div class="d-flex">
                                <p class="pronunciation  opacity-75 "><strong> US:</strong> <? echo $lemma->pronunciation_arr[0]->IPA ?>&nbsp;&nbsp;&nbsp;</p>
                                <p class="pronunciation opacity-75 "><strong> UK:</strong> <? echo $lemma->pronunciation_arr[1]->IPA ?></p>
                            </div>
                            <p class="word_definition h-auto fw-bold" align ="jusitify"> <? echo $lemma->meaning_arr[0]->meaning?>
                            <p class="word_definition " align ="jusitify"> <? echo $lemma->meaning_arr[0]->explanation?>
                            </p>
                        </div>
                    </div>
                <? endforeach ?>  
                      
                </div> 
            </div>
        </div>
        <? else : ?>
        <div class="section-heading xx-large">Nơi này trống trải quá, hãy thêm từ vào yêu thích nhé!</div>
        <? endif ?>
        <script>
            
        var currentFocus = -1;
        autocomplete(document.getElementById("inp_search"),"inp_save",'ajax_call_action.php?action=search');
        function showDetail(lemmaID){
            let data = {
                lemmaID : lemmaID,
            };
            $.ajax({
                url: "ajax_call_action.php?action=favoriteDetail",
                data: data,
                dataType: 'json',
                success: function (response){
                    loadDataDetail(response.data);
                    console.log(response.data);
                }
            })
        }
        function loadDataDetail(lemma){
            let detail = document.getElementsByClassName("word-detail")[0];
            console.log(detail);
            console.log((lemma));
            let html = '';
            html += '<div class="card round-5 padding-5">\
                <h3 class="part-of-speech "> ' +lemma["partOfSpeech"] +'</h3>\
                <div class="title_n_heart">\
                    <h3 class="word_title text-reset">'+ lemma["keyL"] +'</h3>\
                    <a class="mdi-b heart-icon _selected" hint="Yêu thích" href="#"></a>\
                </div>\
                <p class="word_pronunciation  text-reset opacity-75 ">'+ lemma['pronunciation_arr'][0]["IPA"] +'</p>\
                <p class="word_pronunciation  text-reset opacity-75 ">'+ lemma['pronunciation_arr'][1]["IPA"] +'</p>';
                for(let i = 0; i<lemma['meaning_arr'].length; i++){
                    html += '<p class="word_definition h-auto fw-bold" align ="jusitify">'+ lemma['meaning_arr'][i].meaning +' </p>';
                    html += '<p class="word_definition text-reset" align ="jusitify">'+ lemma['meaning_arr'][i].explanation +' </p>';
                    html += '<i class="example " align ="jusitify">Example:</i>';
                    for (let j =0; j < lemma['meaning_arr'][i]['example_arr'].length; j++){
                        html += '<i class="example " align ="jusitify">'+ lemma['meaning_arr'][i]['example_arr'][i].explanation +'</i>';
                    }
                    
                }
                html += '</div>';
                detail.innerHTML = html;
            detail.classList.remove("_closed");
            console.log(detail.classList);
            
        
        }
        document.addEventListener("click", function (e) {
            //Xóa nếu target của cú click không phải là thanh tìm kiếm hoặc khung autocomplete
            document.getElementsByClassName("word-detail")[0].classList.add("_closed");
        });
        // autocomplete(document.getElementById("inp_search"), countries);
        // Hết phần autocomplete
        
        // Bắt đầu phần read more của card
        // var read_more = document.getElementsByClassName("word_read_more");
        // for(var i=0; i< read_more.length; i++){
        //     read_more[i].addEventListener("click", function(e){
        //         if(this.getAttribute("name") != null)
        //         if(this.getAttribute("name").localeCompare("last_col") == 0){
        //             read_more[i-2].parentNode.parentNode.parentNode.style.display = "none";
        //         }
        //         if(this.innerText.localeCompare('Read more...') == 0){
        //             this.innerText = 'Hide';
        //             this.style = "position: absolute; bottom: -10rem; right: 10rem;";
        //             this.parentNode.style.position = "relative";
        //             this.parentNode.style.height = 'unset';
        //             this.parentNode.parentNode.parentNode.style.minWidth = '624rem';
        //             this.parentNode.style.overflow = 'visible';
        //         }
        //         else{
        //             this.innerText = 'Read more...';
        //             this.style.removeProperty('position');
        //             this.parentNode.style.removeProperty('height');
        //             this.parentNode.parentNode.parentNode.style.removeProperty('min-width');
        //             this.parentNode.style.overflow = 'hidden';
        //             read_more[i-2].parentNode.parentNode.parentNode.style.removeProperty('display');

        //         }
                
        //     })
        // }
            </script>
                
        
        <?
    }
}
?>
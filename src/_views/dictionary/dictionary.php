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
    public Meaning $meaning;
    public Lemma $lemma;
    public Example $example;
    public Conjugation $conjugation;
    public Pronunciation $pronunciation;
    public $meaning_arr = array();
    public $example_arr = array();
    public $pronunciation_arr = array();
    public $conjugation_arr = array();
    public function __construct()
    {
        parent::__construct();

    }
    public function detail_contruct($lemma,$meaning,$example,$conjugation,$pronunciation)
    {
        $this->lemma = $lemma;
        $this->meaning_arr = $meaning;
        $this->example_arr = $example;
        $this->conjugation_arr = $conjugation;
        $this->pronunciation_arr = $pronunciation;

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
            "/clients/css/dictionary/dictionary-main.css",
            "/clients/css/home/home_main.css",
            "/clients/css/header/header.css",
            "/clients/css/footer/footer.css"
        );
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
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
                    foreach(($this->pronunciation_arr) as $item)
                        echo '<p class="  text-reset opacity-75 " > <strong>'. $item->region .'</strong>: '.$item->IPA. '  </p>';
                    echo '</span>';
                    foreach(($this->meaning_arr) as $item){
                        echo '<p class="word_definition text-reset" align ="jusitify"> '.$item->meaning .' </p>';
                        echo '<p class="word_definition text-reset" align ="jusitify"> '.$item->explanation .' </p>';
                    }

                    echo '<i class="example " align ="jusitify">Example:</i>';
                    foreach(($this->example_arr) as $item)  {
                        echo '<i class="example " align ="jusitify">'.$item->example .'</i>';
                        echo '<i class="example " align ="jusitify">'.$item->explanation .'</i>';}

                    echo '<p class="conjugation " align ="jusitify">';
                    $firstPrint = true;
                    foreach(($this->conjugation_arr) as  $item)  {
                        if($firstPrint){
                            echo $item['description'].' <a href="#">'.$item['lemma']->keyL.'</a>  '; 
                            $firstPrint = false;
                        } else
                            echo ' | '.$item['description'].' <a href="#">'.$item['lemma']->keyL.'</a>  ';}
                    echo '</p> 
                </div>
                </div>';
            }
            ?>
        </div>
        <script defer>
        
        var currentFocus = -1;
        function autocomplete(inp) {
            // cái input tag
            inp.addEventListener("input", function(e) {

                closeAllLists(inp);
                var val = this.value;
                if (!this.value)
                    {return false;}
                currentFocus = -1;
                var data = {
                    input : val
                };
                //gọi ajax tìm từ
                $.ajax({
                    url : 'ajax_call_action.php?action=search',
                    data : data,
                    dataType: 'json',
                    success : function(response)
                    {
                        if(response.status == '204')
                        {
                            show_autocomplete(inp,val,response.items);
                        }
                        else if(response.status == '404')
                        {
                            closeAllLists(inp);
                        }
                    }
                });
            });

            //Xử lí bàn phím
            inp.addEventListener("keydown", function(e) {
                console.log(currentFocus);
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                    }
                }
            });

            document.addEventListener("click", function (e) {
                //Xóa nếu target của cú click không phải là thanh tìm kiếm hoặc khung autocomplete
                closeAllLists(inp,e.target);
            });
        }
        function show_autocomplete(inp,val,data){   
            
            //Đóng danh sách đang mở nếu có
            var a, b, i;
            a = document.createElement("DIV");
            a.setAttribute("id", inp.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            // Thêm div vào chung container mẹ với tag input    
            inp.parentNode.appendChild(a);
                    
            for (i = 0; i < data.length; i++) {
            // Kiểm tra trùng chữ cái đầu
                    // Tạo div item cho mỗi mục trùng với input
                    b = document.createElement("DIV");
                    // In đậu những kí tự trùng
                    b.innerHTML = "<strong>" + data[i].KeyL.substr(0, val.length) + "</strong>";
                    b.innerHTML += data[i].KeyL.substr(val.length);
                    // Tạo trường input để chứa giá trị của item 
                    b.innerHTML += "<input type='hidden' id='"+ data[i].ID +"' value='" + data[i].KeyL + "'>";
                    // Thêm event khi nhấn vào item sẽ in value vào input luôn
                    b.addEventListener("click", function(e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*Sau khi nhấn thì đóng danh sách*/
                        closeAllLists(inp);
                    });
                // Thêm item vừa tạo vào div chứa
                a.appendChild(b);
            }  
        }
        
        function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }
        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(inp, elmnt) {
            //Xóa các mục autocomplete
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
            }
        }
        }
        
        autocomplete(document.getElementById("inp_search"));
        
        // Hết phần autocomplete    
        </script>
    <?}
}
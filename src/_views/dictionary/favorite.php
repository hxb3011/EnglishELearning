<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class DictionaryFavoritePage extends BaseHTMLDocumentPage
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
        <div class="word-detail _closed">
            <div class="card round-5 padding-5">
                <h3 class="part-of-speech ">Noun</h3>
                <div class="title_n_heart">
                    <h3 class="word_title text-reset">Coffee</h3>
                    <a class="mdi-b heart-icon " hint="Yêu thích" href="#"></a>
                </div>
                <p class="word_pronunciation  text-reset opacity-75 ">/ˈkɒfi/</p>
                <p class="word_definition text-reset" align ="jusitify"> a dark brown powder with a strong flavour and smell that is made by crushing dark beans from a tropical bush and used to make a drink </p>
                <i class="example " align ="jusitify">Example:</i>
                <i class="example " align ="jusitify">Instant coffee just doesn't compare with freshly ground coffee.</i>
                <i class="example " align ="jusitify"> The delicious smell of freshly-made coffee came from the kitchen.</i>
                <i class="example " align ="jusitify">Brazil earns many millions of pounds a year from coffee exports.</i>
                <i class="example " align ="jusitify">Instant coffee just doesn't compare with freshly ground coffee.</i>
                <i class="example " align ="jusitify"> The delicious smell of freshly-made coffee came from the kitchen.</i>
                <i class="example " align ="jusitify">Brazil earns many millions of pounds a year from coffee exports.</i>
                <i class="example " align ="jusitify">Instant coffee just doesn't compare with freshly ground coffee.</i>
                <i class="example " align ="jusitify"> The delicious smell of freshly-made coffee came from the kitchen.</i>
                <i class="example " align ="jusitify">Brazil earns many millions of pounds a year from coffee exports.</i>
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
                    <div class=" col col-sm-2  margin-5">
                        <div class="card  round-5 padding-5" >
                            <h3 class="part-of-speech ">Noun</h3>
                            <div class="title_n_heart">
                                <h3 class=" word_title text-reset">Coffee</h3>
                                <a class="mdi-b heart-icon  _selected" hint="Yêu thích" href="#"></a>
                            </div>
                            <p class="text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them
                                <a class="word_read_more opacity-75" href="#">Read more...</a>
                            </p>
                        </div>
                    </div>
                    <div class="col col-sm-2 margin-5">
                        <div class="card round-5 padding-5">
                            <h3 class="part-of-speech ">Noun</h3>
                            <div class="title_n_heart">
                                <h3 class=" word_title text-reset">Coffee</h3>
                                <a class="mdi-b heart-icon  " hint="Yêu thích" href="#"></a>
                            </div>
                            <p class="text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them ; a powder made from them them 
                                <a class="word_read_more opacity-75" href="#">Read more...</a>
                                <span>đoạn dài hơn bị ẩn đi, sau khi hiện ra khi ấn read more test 01</span>
                            </p>
                        </div>
                    </div>
                    <div class=" col col-sm-2  margin-5">
                        <div class="card  round-5 padding-5">
                            <h3 class="part-of-speech ">Noun</h3>
                            <div class="title_n_heart">
                                <h3 class=" word_title text-reset">Coffee</h3>
                                <a class="mdi-b heart-icon  _selected" hint="Yêu thích" href="#"></a>
                            </div>
                            <p class="text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them ; a powder made from them them 
                                <a class="word_read_more opacity-75" href="#">Read more...</a>
                                <span>đoạn dài hơn bị ẩn đi, sau khi hiện ra khi ấn read more test 01</span>
                            </p>
                        </div>
                    </div>
                    <div class=" col col-sm-2  margin-5">
                        <div class="card round-5 padding-5">
                            <h3 class="part-of-speech ">Noun</h3>
                            <div class="title_n_heart">
                                <h3 class=" word_title text-reset">Coffee</h3>
                                <a class="mdi-b heart-icon  _selected" hint="Yêu thích" href="#"></a>
                            </div>
                            <p class="text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them ; a powder made from them them 
                                <a class="word_read_more opacity-75" name="last_col" href="#">Read more...</a>
                                <span>đoạn dài hơn bị ẩn đi, sau khi hiện ra khi ấn read more test 01</span>
                            </p>
                        </div>
                    </div>
                    <div class=" col col-sm-2  margin-5">
                        <div class="card round-5 padding-5">
                            <h3 class="part-of-speech ">Noun</h3>
                            <div class="title_n_heart">
                                <h3 class=" word_title text-reset">Coffee</h3>
                                <a class="mdi-b heart-icon  _selected" hint="Yêu thích" href="#"></a>
                            </div>
                            <p class="text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them</p>
                        </div>
                    </div> 
                    <div class=" col col-sm-2 margin-5">
                        <div class="card round-5 padding-5">
                            <h3 class="part-of-speech ">Noun</h3>
                            <div class="title_n_heart">
                                <h3 class=" word_title text-reset">Coffee</h3>
                                <a class="mdi-b heart-icon  _selected" hint="Yêu thích" href="#"></a>
                            </div>
                            <p class="text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them</p>
                        </div>
                    </div> 
                    <div class=" col col-sm-2 margin-5">
                        <div class="card round-5 padding-5">
                            <h3 class="part-of-speech ">Noun</h3>
                            <div class="title_n_heart">
                                <h3 class=" word_title text-reset">Coffee</h3>
                                <a class="mdi-b heart-icon  _selected" hint="Yêu thích" href="#"></a>
                            </div>
                            <p class="text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them</p>
                        </div>
                    </div> 
                    <div class=" col col-sm-2 margin-5">
                        <div class="card  round-5 padding-5">
                            <h3 class="part-of-speech ">Noun</h3>
                            <div class="title_n_heart">
                                <h3 class=" word_title text-reset">Coffee</h3>
                                <a class="mdi-b heart-icon  _selected" hint="Yêu thích" href="#"></a>
                            </div>
                            <p class="text-reset opacity-75 ">/ˈkɒfi/</p>
                            <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them</p>
                        </div>
                    </div>   
                </div>   
            </div>
        </div>
        <script>
        function autocomplete(inp, arr) {
            // Nhận 2 giá trị đầu vào: cái input tag và bảng dữ liệu
            var currentFocus;
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                // xóa tất cả danh sách đang hiện nếu có
                closeAllLists();
                if (!val) { return false;}
                currentFocus = -1;
                // Tạo div để chứa các mục autocomplete
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                // Thêm div vào chung container mẹ với tag input
                this.parentNode.appendChild(a);
                
                for (i = 0; i < arr.length; i++) {
                    // Kiểm tra trùng chữ cái đầu
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        // Tạo div item cho mỗi mục trùng với input
                        b = document.createElement("DIV");
                        // In đậu những kí tự trùng
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        // Tạo trường input để chứa giá trị của item trùng
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        // Thêm event khi nhấn vào item sẽ in value vào input luôn
                        b.addEventListener("click", function(e) {
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*Sau khi nhấn thì đóng danh sách*/
                            closeAllLists();
                    });
                    // Thêm item vừa tạo vào div chứa
                    a.appendChild(b);
                    }
                }
            });
            //Xử lí bàn phím
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
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
            function closeAllLists(elmnt) {
                //Xóa các mục autocomplete
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
                }
            }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function (e) {
                //Xóa nếu target của cú click không phải là thanh tìm kiếm hoặc khung autocomplete
                closeAllLists(e.target);
            });                 
            }
        var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
        autocomplete(document.getElementById("inp_search"), countries);
        // Hết phần autocomplete
        
        // Bắt đầu phần read more của card
        var read_more = document.getElementsByClassName("word_read_more");
        for(var i=0; i< read_more.length; i++){
            read_more[i].addEventListener("click", function(e){
                if(this.getAttribute("name") != null)
                if(this.getAttribute("name").localeCompare("last_col") == 0){
                    read_more[i-2].parentNode.parentNode.parentNode.style.display = "none";
                }
                if(this.innerText.localeCompare('Read more...') == 0){
                    this.innerText = 'Hide';
                    this.style = "position: absolute; bottom: -10rem; right: 10rem;";
                    this.parentNode.style.position = "relative";
                    this.parentNode.style.height = 'unset';
                    this.parentNode.parentNode.parentNode.style.minWidth = '624rem';
                    this.parentNode.style.overflow = 'visible';
                }
                else{
                    this.innerText = 'Read more...';
                    this.style.removeProperty('position');
                    this.parentNode.style.removeProperty('height');
                    this.parentNode.parentNode.parentNode.style.removeProperty('min-width');
                    this.parentNode.style.overflow = 'hidden';
                    read_more[i-2].parentNode.parentNode.parentNode.style.removeProperty('display');

                }
                
            })
        }
            </script>
                
        
        <?
    }
}
?>
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
// public function head()
//     {
//         $this->style(
//             "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css",
//             "sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
//         );
//         $this->script(
//             "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",
//             "sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
//         );
//         $this->styles(
//             "/clients/css/dictionary/dictionary.css"
//             "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css",
//             "/clients/css/dictionary/dictionary.css",
//             "/clients/css/home/home_main.css",
//             "/clients/css/header/header.css",
//             "/clients/css/footer/footer.css"
//         );
//         $this->scripts(
//             "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
//             "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
//             "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
//         );
//         // $this->scripts(

// @@ -45,8 +62,117 @@ public function body()
//         <div class="container mt-5 mb-5" >
//             <div class="section-heading section-heading--lg ">Dictionary</div>
//             <div class = "container flashcard__container">
//                 <div class="">
//                     <form class="form-inline my-2 my-lg-0 d-flex w-50 mx-auto" autocomplete="off">
//                     <div class="autocomplete w-100">
//                         <input class="form-control form-control-lg border border-dark rounded-0 rounded-start mr-sm-2 search_bar " id="inp_search" type="search" placeholder="Search" aria-label="Search">
//                     </div>
//                     <button class="btn btn-dark my-2 my-sm-0 rounded-0 rounded-end search_button" type="submit">
//                         <i class="fas fa-search "></i>
//                     </button>
//                     </form>
//                 </div>
//                 <script>
//                 function autocomplete(inp, arr) {
//                         /*the autocomplete function takes two arguments,
//                         the text field element and an array of possible autocompleted values:*/
//                         var currentFocus;
//                         /*execute a function when someone writes in the text field:*/
//                         inp.addEventListener("input", function(e) {
//                             var a, b, i, val = this.value;
//                             /*close any already open lists of autocompleted values*/
//                             closeAllLists();
//                             if (!val) { return false;}
//                             currentFocus = -1;
//                             /*create a DIV element that will contain the items (values):*/
//                             a = document.createElement("DIV");
//                             a.setAttribute("id", this.id + "autocomplete-list");
//                             a.setAttribute("class", "autocomplete-items");
//                             /*append the DIV element as a child of the autocomplete container:*/
//                             this.parentNode.appendChild(a);
//                             /*for each item in the array...*/
//                             for (i = 0; i < arr.length; i++) {
//                                 /*check if the item starts with the same letters as the text field value:*/
//                                 if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
//                                     /*create a DIV element for each matching element:*/
//                                     b = document.createElement("DIV");
//                                     /*make the matching letters bold:*/
//                                     b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
//                                     b.innerHTML += arr[i].substr(val.length);
//                                     /*insert a input field that will hold the current array item's value:*/
//                                     b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
//                                     /*execute a function when someone clicks on the item value (DIV element):*/
//                                     b.addEventListener("click", function(e) {
//                                     /*insert the value for the autocomplete text field:*/
//                                     inp.value = this.getElementsByTagName("input")[0].value;
//                                     /*close the list of autocompleted values,
//                                     (or any other open lists of autocompleted values:*/
//                                     closeAllLists();
//                                 });
//                                 a.appendChild(b);
//                                 }
//                             }
//                         });
//                         /*execute a function presses a key on the keyboard:*/
//                         inp.addEventListener("keydown", function(e) {
//                             var x = document.getElementById(this.id + "autocomplete-list");
//                             if (x) x = x.getElementsByTagName("div");
//                             if (e.keyCode == 40) {
//                                 /*If the arrow DOWN key is pressed,
//                                 increase the currentFocus variable:*/
//                                 currentFocus++;
//                                 /*and and make the current item more visible:*/
//                                 addActive(x);
//                             } else if (e.keyCode == 38) { //up
//                                 /*If the arrow UP key is pressed,
//                                 decrease the currentFocus variable:*/
//                                 currentFocus--;
//                                 /*and and make the current item more visible:*/
//                                 addActive(x);
//                             } else if (e.keyCode == 13) {
//                                 /*If the ENTER key is pressed, prevent the form from being submitted,*/
//                                 e.preventDefault();
//                                 if (currentFocus > -1) {
//                                 /*and simulate a click on the "active" item:*/
//                                 if (x) x[currentFocus].click();
//                                 }
//                             }
//                         });
//                         function addActive(x) {
//                             /*a function to classify an item as "active":*/
//                             if (!x) return false;
//                             /*start by removing the "active" class on all items:*/
//                             removeActive(x);
//                             if (currentFocus >= x.length) currentFocus = 0;
//                             if (currentFocus < 0) currentFocus = (x.length - 1);
//                             /*add class "autocomplete-active":*/
//                             x[currentFocus].classList.add("autocomplete-active");
//                         }
//                         function removeActive(x) {
//                             /*a function to remove the "active" class from all autocomplete items:*/
//                             for (var i = 0; i < x.length; i++) {
//                             x[i].classList.remove("autocomplete-active");
//                             }
//                         }
//                         function closeAllLists(elmnt) {
//                             /*close all autocomplete lists in the document,
//                             except the one passed as an argument:*/
//                             var x = document.getElementsByClassName("autocomplete-items");
//                             for (var i = 0; i < x.length; i++) {
//                             if (elmnt != x[i] && elmnt != inp) {
//                             x[i].parentNode.removeChild(x[i]);
//                             }
//                         }
//                         }
//                         /*execute a function when someone clicks in the document:*/
//                         document.addEventListener("click", function (e) {
//                             closeAllLists(e.target);
//                         });                 
//                         }
//                         var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
//                         autocomplete(document.getElementById("inp_search"), countries);</script>
//                 <div class="row mt-5 justify-content-center">
//                     <div class="col-xs-8 col-sm-6 col-md-6 col-lg-3 my-3">
//                 <div class=" col col-xl-3 col-lg-4 my-3">
//                         <div class="card text-bg-dark text-light rounded-5 p-5">
//                             <h3 class="pretitle text-end ">Noun</h3>
//                             <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
// @@ -55,7 +181,7 @@ public function body()
//                             <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them</p>
//                         </div>
//                     </div>
//                     <div class="col-xs-8 col-sm-6 col-md-6 col-lg-3 my-3">
//                     <div class="col col-xs-2 col-sm-2 col-md-6 col-lg-4 my-3">
//                         <div class="card text-bg-dark text-light rounded-5 p-5">
//                             <h3 class="pretitle text-end ">Noun</h3>
//                             <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
// @@ -64,7 +190,7 @@ public function body()
//                             <p class="word_definition text-reset" align ="jusitify"> the roasted seeds (called coffee beans) of a tropical bush; a powder made from them</p>
//                         </div>
//                     </div>
//                     <div class="col-xs-8 col-sm-6 col-md-6 col-lg-3 my-3">
//                     <div class="col-xs-8 col-sm-6 col-md-6 col-lg-4 my-3">
//                         <div class="card text-bg-dark text-light rounded-5 p-5">
//                             <h3 class="pretitle text-end ">Noun</h3>
//                             <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
/*<?
final class Component {
    public function __construct()
    {
    }

    public function styleHeaderFooter()
    {
        ?><link rel="stylesheet" href="/clients/css/header/header.css"><?
        ?><link rel="stylesheet" href="/clients/css/header/header.css"><?
    }

    public function insertHeader()
    {
        if(!isset($hideHeader))
        {
            ?>
            <div class="header ">
                <nav class="navbar navbar-expand-lg  header__navbar">
                    <div class="container">
                        <div class="header__navbar__brand-wrapper">
                            <a class="navbar-brand header__navbar-brand" href="/">
                                <img src="/assets/images/icon.png" class="header__navbar-logo" alt="Logo">
                                ELearning
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse header__navbar-menu-wrapper" id="navbarSupportedContent">
                            <ul class="navbar-nav mb-2 mb-lg-0 header__navbar-menu">
                                <li class="nav-item header__navbar-menu__item active">
                                    <a class="nav-link " aria-current="page" href="/">Trang chủ</a>
                                </li>
                                <li class="nav-item header__navbar-menu__item">
                                    <a class="nav-link  " href="/courses/all">Khóa học</a>
                                </li>
                                <li class="nav-item header__navbar-menu__item">
                                    <a class="nav-link " href="/blog/all">Blog</a>
                                </li>
                                <li class="nav-item header__navbar-menu__item">
                                    <a class="nav-link " href="/home/faqs">FAQs</a>
                                </li>
                                <li class="nav-item header__navbar-menu__item">
                                    <a class="nav-link " href="/home/contact">Liên hệ</a>
                                </li>
                            </ul>
                            <div class="d-flex header__auth justify-content-end align-items-center ">
                                <a href="/authen/auth" class="header__auth-link">
                                    Login/Register
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>

                <? 
                    $currentURI = $_SERVER['REQUEST_URI'];
                    $currentPage = explode('/', $currentURI);
                    foreach ($currentPage as $key => $value) {
                        if (strpos($value, '.php') !== false) {
                            $currentPage = explode('.', $value)[0];
                        }
                    }
                ?>
                <!-- Cập nhật lại sau-->
                <!-- <div class="navigation">
                    <div class="container">
                        <?
                            echo "<ul>";
                            echo "<li><a href='/content/views/home.php' class='nav-link'>Home </a></li>";
                            if ($currentPage != 'home'){
                                echo " > ";
                            }
                            if ($currentPage == 'bloglist'){
                                echo "<li><a href='/content/views/bloglist.php' class='nav-link'>Blog </a></li>";
                            }
                        ?>
                    </div>
                </div> -->
            </div>
            <?
        }
    }
    public function insertFooter(){
    ?>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex">
                            <a class="navbar-brand header__navbar-brand" href="#">
                                <img src="/assets/images/icon.png" class="header__navbar-logo" alt="Logo">
                                ELearning
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <div class="footer-heading ">
                            Cần trợ giúp ?
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <div class="footer-heading ">
                            Khóa học
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <div class="footer-heading ">
                            Liên hệ
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p class="footer_greeting ">
                            Chào mừng đến với trang web học tiếng Anh trực tuyến! Chúng tôi cung cấp một nền tảng học tập linh hoạt và tiện lợi cho mọi người muốn nâng cao kỹ năng tiếng Anh của mình. Với hàng trăm bài học, bài kiểm tra, và tài nguyên học liệu đa dạng, chúng tôi cam kết mang đến trải nghiệm học tập tích cực và hiệu quả nhất cho bạn."
                        </p>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center">
                        <ul class="footer__list">
                            <li class="footer__list-item">
                                <a href="#" class="footer__list-item__link">
                                    Liên hệ
                                </a>
                            </li>
                            <li class="footer__list-item">
                                <a href="#" class="footer__list-item__link">
                                    Bài viết mới
                                </a>
                            </li>
                            <li class="footer__list-item">
                                <a href="#" class="footer__list-item__link">
                                    FAQ
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center">
                        <ul class="footer__list">
                            <li class="footer__list-item">
                                <a href="#" class="footer__list-item__link">
                                    Các khóa học
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="footer_text">Address: 273 Đ. An Dương Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh</p>
                        <p class="footer_text"><img src="" class="footer-icon" alt="">Tel:+ (123) 2500-567-8988</p>
                        <p class="footer_text"><img src="" class="footer-icon" alt="">Phone:+ (123) 2500-567-8988</p>

                    </div>
                </div>
                <hr>
                <span class="copyright d-flex justify-content-center">Copyright © 2024 LMS | Powered by TeamDev</span>
            </div>
            <!-- Back to Top -->
            <button id="back-to-top" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></button>
        </footer>
        <script src="/clients/utils/backToTop.js"></script>
    <?
    }
}*/
?>
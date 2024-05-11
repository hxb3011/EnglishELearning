<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class AuthenticatePage extends BaseHTMLDocumentPage
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
        parent::documentInfo($author, $description, "Đăng nhập - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Đăng nhập - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css",
            "/clients/css/login/authenticate.css",
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"   
        );
        $this->scripts(
            "https://code.jquery.com/jquery-3.5.1.min.js",
            "/clients/js/authenticate/authenticate.js",
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        );
    }

    public function body()
    {
        ?>
        <div class="container-authen sign-up-mode">
            <div class="forms-container">
                <div class="signin-signup">
                    <!-- Sign in -->
                    <!-- <form id="signinform" action="" method="POST" class="sign-in-form">
                        <h2 class="title">Sign in</h2>
                        <div id="result" class="text-lg alert d-none rounded"></div>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" id="username" placeholder="Email or username" required>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input class="input" id="password" type="password" placeholder="Password" required>
                            <i class="fa-solid fa-eye" data-index="0"></i>
                        </div>
                        <a href="/authentication/forgetPassword.php" class="btn-link">Forgot password?</a>
                        <input type="submit" id="loginbtn" value="login" class="btn solid">

                        <p class="text-lg">Or Sign in with social platforms</p>
                        <div class="line-seperate"></div>
                        <div class="social-media">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </form> -->

                    <!-- Sign-up  -->
                    <form id="signupform" action="" method="POST" class="sign-up-form">
                        <h2 class="title">Sign up</h2>
                        <div class="alert text-lg d-none rounded" id="error"></div>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" id="firstName-register" placeholder="First Name" required>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" id="lastName-register" placeholder="Last Name" required>
                        </div>
                        <div class="input-field-group">
                            <i class="fas fa-user"></i>
                            <div>
                                <input type="radio" name="gender" id="gender-male-register">
                                <label for="gender-male-register">Male</label>
                                <input type="radio" name="gender" id="gender-female-register">
                                <label for="gender-female-register">Female</label>
                            </div>
                        </div>
                        <div class="input-field-date">
                            <i class="fa-solid fa-calendar-days"></i>
                            <input class="input" id="date-register" type="date" required>
                        </div>
                        <input type="submit" id="registerbtn" value="Sign Up" class="btn solid">

                        <p class="text-lg">Or Sign up with social platforms</p>
                        <div class="line-seperate"></div>
                        <div class="social-media">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>New here ?</h3>
                        <p>Bạn chưa có tài khoản, hãy đăng ký ở dưới đây</p>
                        <button class="btn btn-transaparent" id="sign-up-btn">Sign Up</button>
                    </div>
                    <img src="/assets/images/log.svg" class="image" alt="">
                </div>

                <div class="panel right-panel">
                    <img src="/assets/images/register.svg" class="image" alt="">
                </div>
            </div>
        </div>

        <script>
            // Xử lý sliding signin-singup
            let sign_in_btn = document.querySelector("#sign-in-btn");
            let sign_up_btn = document.querySelector("#sign-up-btn");
            let container = document.querySelector(".container-authen");

            sign_up_btn.addEventListener("click", () => {
                container.classList.add("sign-up-mode");
            });

            // sign_in_btn.addEventListener("click", () => {
            //     container.classList.remove("sign-up-mode");
            // });

            //Xử lý ẩn/hiện password
            let inputs = document.querySelectorAll(".input");
            let eyeIcons = document.querySelectorAll(".fa-solid.fa-eye");

            eyeIcons.forEach((eyeIcon, index)=> {
                eyeIcon.addEventListener('click',()=>{
                    if (inputs[index].type === "password"){
                        inputs[index].setAttribute('type','text')
                        eyeIcon.classList.remove("fa-eye");
                        eyeIcon.classList.add("fa-eye-slash");
                    } else {
                        inputs[index].setAttribute('type','password');
                        eyeIcon.classList.remove("fa-eye-slash");
                        eyeIcon.classList.add("fa-eye");
                    }
                })
            }) 
        </script>
        <?
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>
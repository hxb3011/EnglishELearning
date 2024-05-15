$(document).ready(function () {
    $("#loginbtn").click(function (e) {
        e.preventDefault();
        authenticate();
    });
    $("#registerbtn").click(function (e) {
        e.preventDefault();
        register();
    });
    $("#nextBtn").click(function (e) {
        e.preventDefault();
        nextProfile();
    });
})

function nextProfile() {
    let username = $("#username-register").val();
    let password = $("#password-register").val();
    let email = $("#email-register").val();
    let retypePassword = $("#retype-password-register").val();
    if (checkValidateRegisterForm(username, email, password, retypePassword)) {
        sessionStorage.setItem("profiles", JSON.stringify({ username: username, password: password, email: email }));
        window.location.href = "/authentication/authenticateSubmit.php";
    }
}

function authenticate() {
    let username = $("#username").val();
    let password = $("#password").val();
    let formdata = { action: "login", username: username, password: password };
    if (checkValidateLoginForm(username, password)) {
        $.ajax({
            type: "POST",
            url: "/authentication/checkLogin.php",
            data: JSON.stringify(formdata),
            contentType: "application/json",
            success: function (data) {
                console.log(data)
                if (data == "success") {
                    // console.log("Login success");
                    let url = new URL(window.location.href);
                    let redirect = url.searchParams.get("uri");
                    if (!redirect) {
                        redirect = "/introduction/index.php";
                    }
                    console.log(redirect);
                    window.location.href = redirect;
                } else {
                    console.log("Login failed");
                    checkUIformLogin();
                    document.getElementById("result").classList.add("alert-danger");
                    $("#result").text(data);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
            }
        });
    }
}





function register() {
    let username = sessionStorage.getItem("profiles") ? JSON.parse(sessionStorage.getItem("profiles")).username : $("#username-register").val();
    let password = sessionStorage.getItem("profiles") ? JSON.parse(sessionStorage.getItem("profiles")).password : $("#password-register").val();
    let email = sessionStorage.getItem("profiles") ? JSON.parse(sessionStorage.getItem("profiles")).email : $("#email-register").val();
    let firstname = $("#firstName-register").val();
    let lastname = $("#lastName-register").val();
    let gender = $("#gender-male-register").is(':checked') ? "male" : "female";
    let birthday = new Date($("#date-register").val().toString()).toISOString().slice(0, 10);
    let formdata = { action: "register", username, password, email, firstname, lastname, gender, birthday};
    if (checkValidateFormRegisterTwo(firstname, lastname,gender,birthday)) {
        $.ajax({
            type: "POST",
            url: "/authentication/checkRegister.php",
            data: JSON.stringify(formdata),
            contentType: "application/json",
            success: function (data) {
                // console.log(data);
                if (data == "success") {
                    checkUI();
                    document.getElementById("error").classList.add("alert-success");
                    $("#error").text("Register success");
                    destroySession();
                    reflecttionHandler("success");
                } else {
                    checkUI();
                    document.getElementById("error").classList.add("alert-danger");
                    $("#error").html(data);
                    reflecttionHandler("failed");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                checkUI();
                $("#error").html(errorThrown);
            }
        });
    }
}

function reflecttionHandler(status){
    setTimeout(()=> {
        window.location.href = "/authentication/authenticate.php";
    },3000);
    if (status == "failed") {
        let container = document.querySelector(".container-authen");
        container.classList.add("sign-up-mode");
        console.log(JSON.parse(sessionStorage.getItem("profiles")).email);
        $("#username-register").val(sessionStorage.getItem("profiles") ? JSON.parse(sessionStorage.getItem("profiles")).username : "");
        $("#email-register").val(sessionStorage.getItem("profiles") ? JSON.parse(sessionStorage.getItem("profiles")).email : "");
    }
}

function checkUI() {
    if (!document.getElementById("error").classList.contains("d-block")) {
        document.getElementById("error").classList.remove("d-none");
        document.getElementById("error").classList.add("d-block");
    }
    if (document.getElementById("error").classList.contains("alert-danger")) {
        document.getElementById("error").classList.remove("alert-danger");
    }
    if (document.getElementById("error").classList.contains("alert-success")) {
        document.getElementById("error").classList.remove("alert-success");
    }
}

function checkUIformLogin() {
    if (!document.getElementById("result").classList.contains("d-block")) {
        document.getElementById("result").classList.remove("d-none");
        document.getElementById("result").classList.add("d-block");
    }
    if (document.getElementById("result").classList.contains("alert-danger")) {
        document.getElementById("result").classList.remove("alert-danger");
    }
    if (document.getElementById("result").classList.contains("alert-success")) {
        document.getElementById("result").classList.remove("alert-success");
    }
}

function checkValidateFormRegisterTwo(firstname, lastname, gender, birthday){
    if (firstname == "" || lastname == "" || gender == "" || birthday == "") {
        checkUI();
        document.getElementById("error").classList.add("alert-danger");
        $("#error").text("Please fill out all fields");
        return false;
    }
    if (!checkValidDateOfBirthday(birthday)) {
        checkUI();
        document.getElementById("error").classList.add("alert-danger");
        $("#error").text("Invalid date of birthday");
        return false;
    }
    if (!checkDateOfBirthday(birthday)) {
        checkUI();
        document.getElementById("error").classList.add("alert-danger");
        $("#error").text("Date of birthday must be less than today");
        return false;
    }
    return true;
}

function checkEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function checkUsername(username) {
    var re = /^[a-zA-Z0-9]*$/;
    return re.test(username);
}

function checkPassword(password) {
    if (password.length < 6) {
        return false;
    }
    return true;
}

function checkRetypePassword(password, retypePassword) {
    if (password != retypePassword) {
        return false;
    }
    return true;
}

function checkValidateLoginForm(subject, password) {
    if (subject.length == 0 && password.length == 0) {
        checkUIformLogin();
        document.getElementById("result").classList.add("alert-danger");
        $("#result").text("Please fill out all fields");
        return false;
    }

    if (!checkPassword(password)) {
        checkUIformLogin();
        document.getElementById("result").classList.add("alert-danger");
        $("#result").text("Password must be at least 6 characters");
        return false;
    }

    if (!checkUsername(subject)) {
        if (!checkEmail(subject)) {
            checkUIformLogin();
            document.getElementById("result").classList.add("alert-danger");
            $("#result").text("Invalid email");
            return false;
        }
    }

    return true;
}

function checkValidateRegisterForm(username, email, password, retypePassword) {
    if (username == "" || email == "" || password == "" || retypePassword == "") {
        checkUI();
        document.getElementById("error").classList.add("alert-danger");
        $("#error").text("Please fill out all fields");
        return false;
    }
    if (!checkEmail(email)) {
        checkUI();
        document.getElementById("error").classList.add("alert-danger");
        $("#error").text("Invalid email");
        return false;
    }

    if (!checkPassword(password)) {
        checkUI();
        document.getElementById("error").classList.add("alert-danger");
        $("#error").text("Password must be at least 6 characters");
        return false;
    }

    if (!checkRetypePassword(password, retypePassword)) {
        checkUI();
        document.getElementById("error").classList.add("alert-danger");
        $("#error").text("Retype password not match");
        return false;
    }
    return true;
}

function destroySession(){
    sessionStorage.clear();
}

function checkValidDateOfBirthday(date){
    var re = /^\d{4}-\d{2}-\d{2}$/;
    return re.test(date);
}

function checkDateOfBirthday(date){
    const today = new Date();
    const birthday = new Date(date);
    if (birthday > today) {
        return false;
    }
    return true;
}

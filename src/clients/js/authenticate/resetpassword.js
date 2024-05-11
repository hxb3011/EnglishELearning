$(document).ready(function () {
    $("#resetbtn").click(function (e) {
        e.preventDefault();
        resetPassword();
    })
})

function resetPassword(){
    let password = $("#password").val();
    let confirm_password = $("#confirm_password").val();
    let currentURL = window.location.href;
    let token = currentURL.split("?")[1].split("=")[1].split("#")[0];
    console.log(token);
    if (!checkPassword(password)){
        checkUI();
        document.getElementById("message").classList.add("alert-danger");
        $("#message").text("Password must be at least 6 characters");
        return;
    }
    if (!checkConfirmPassword(password, confirm_password)){
        checkUI();
        document.getElementById("message").classList.add("alert-danger");
        $("#message").text("Password and confirm password must be the same");
        return;
    }
    let formdata = {
        password: password,
        token : token,
        action: "resetPassword"
    };
    $.ajax({
        url: "/authentication/resetpasswordSV.php",
        type: "POST",
        data: JSON.stringify(formdata),
        contentType: "application/json",
        success: (data) => {
            console.log(data);
            if (data == "success") {
                checkUI();
                document.getElementById("message").classList.add("alert-success");
                $("#message").text("Password has been reset successfully");
                setInterval(()=>{
                    window.location.href = "/authentication/authenticate.php";
                },3000);
            } else {
                checkUI();
                document.getElementById("message").classList.add("alert-danger");
                $("#message").text(data);
            }
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.log(errorThrown);
        }
    });
}

function checkPassword(password){
    if (password.length < 6){
        return false;
    }
    return true;
}

function checkConfirmPassword(password, confirm_password){
    if (password != confirm_password){
        return false;
    }
    return true;
}

function checkUI() {
    if (!document.getElementById("message").classList.contains("d-block")) {
        document.getElementById("message").classList.remove("d-none");
        document.getElementById("message").classList.add("d-block");
    }
    if (document.getElementById("message").classList.contains("alert-danger")) {
        document.getElementById("message").classList.remove("alert-danger");
    }
    if (document.getElementById("message").classList.contains("alert-success")) {
        document.getElementById("message").classList.remove("alert-success");
    }
}
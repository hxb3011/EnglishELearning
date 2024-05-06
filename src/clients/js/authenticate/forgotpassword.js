$(document).ready(function () {
    $("form").submit(function (e) {
        sendEmail(e);
    })
})

function sendEmail(e) {
    e.preventDefault();
    let email = $("#email").val();
    let formdata = {
        email: email,
        action: "forgetPassword"
    };
    if (!checkValidateEmail(email)){
        checkUI();
        document.getElementById("message").classList.add("alert-danger");
        $("#message").text("Invalid email format");
        return;
    }
    $.ajax({
        type: "POST",
        url: "/authentication/forgetPassword.php",
        data: JSON.stringify(formdata),
        contentType: "application/json",
        success: (data) => {
            if (data["status"] == "success") {
                checkUI();
                document.getElementById("message").classList.add("alert-success");
                $("#message").text(data["message"]);
            } else {
                checkUI();
                document.getElementById("message").classList.add("alert-danger");
                $("#message").text(data["message"]);
            }
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.log(errorThrown);
        }
    });
}

function checkValidateEmail(email) {
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(email);
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
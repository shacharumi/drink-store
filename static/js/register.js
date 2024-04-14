function register() {
    let data = {
        email : $("#email").val(),
        username : $("#username").val(),
        password : $("#password").val(),
        phone : $("#phone").val(),
        type : $("#type").val(),
    };
    $.post(
        "../php/register.php",
        data,
        (response, status) => {
            if (status == "success") {
                if (response["status"] == "success") {
                    alert("註冊成功，跳轉到登入頁面");
                    window.location.href = "../login/";
                }
                else {
                    showAlertOnPage(response["error"]);
                }
            }
            else {
                showAlertOnPage("無法註冊");
            }
        }
    )
}


$(document).ready(() => {
    $("#submit").click(() => {
        register();
    })
    $('#email, #username, #password, #phone, #type').keypress(function (e) {
        if (e.which == 13) {
            register();
            return false;
        }
    });
});
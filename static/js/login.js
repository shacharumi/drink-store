function login() {
    let data = {
        account : $("#account").val(),
        password : $("#password").val(),
    };
    let url = "../php/login.php";

    $.post(
        url,
        data,
        (response, status) => {
            if (status == "success") {
                if (response["status"] == "success") {
                    window.location.href = "../home/";
                }
                else {
                    showAlertOnPage(response["error"]);
                }
            }
            else {
                showAlertOnPage("無法登入");
            }
        }
    )
}


$(document).ready(() => {
    $("#submit").click(() => {
        login();
    })
    $('#account, #password').keypress(function (e) {
        if (e.which == 13) {
            login();
            return false;
        }
      });
});
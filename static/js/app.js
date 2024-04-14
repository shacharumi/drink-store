var SUGAR = {
    "0" : "無糖",
    "1" : "1分糖",
    "3" : "微糖",
    "5" : "半糖",
    "7" : "少糖",
    "10" : "全糖", 
}

var ICE = {
    "0" : "完全去冰",
    "1" : "小碎冰",
    "3" : "微冰",
    "5" : "半冰",
    "7" : "少冰",
    "10" : "全冰", 
}

function sortdate(a, b) {
    return new Date(a.time).getTime() - new Date(b.time).getTime();
}

function nullFilter(object) {
    for (let key in object) {
        if (object[key] === null) {
            object[key] = ""
        }
    }
}

function showAlertOnPage(text) {
    $("#warning").text(text);
    $("#warning").addClass("alert alert-danger")
}

function getCookies() {
    let cookies = {};
    let cookiesString = document.cookie.split("; ")
    for (let cookieString of cookiesString){
        let tmp = cookieString.split("=");
        cookies[tmp[0]] = tmp[1]
    }
    return cookies;
}

function convertTime(timeString) {
    return timeString.split(":").slice(0, 2).join(":");
}

function searchOrder(type) {
    if (type == "date") {
        window.location.href = `../order/?sd=${$('#startDate').val()}&ed=${$('#endDate').val()}`;
    }
    if (type == "id") {
        window.location.href = `../order/?o_id=${$("#order-id").val()}`;
    }
}

function openWindow() {
    if (!checkUserLogin) {
        alert("請先登入!");
        return ;
    }
    let pageHeight = Math.max($("body").outerHeight(), $("html").outerHeight());
    let nowPosition = document.documentElement.scrollTop;
    let windowPosition = nowPosition + 130;
    $('.black-cover').css("display", "block");
    $('.black-cover').outerHeight(pageHeight);
    $('.window').css("display", "block");
    $('.window').css("top", windowPosition);
    $("body").css("overflow-y", "hidden");
}

function closeWindow() {
    $(".black-cover").css("display", "none");
    $(".window").css("display", "none");
    $("body").css("overflow-y", "auto");
}

function checkUserLogin() {
    let cookies = getCookies();
    return cookies["id"] !== undefined;
}

function checkObjectData(object) {
    for (let key in object) {
        if (object[key].length === 0) {
            return false;
        }
    }
    return true;
}

$(document).ready(() => {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
    });

    // open window when click button
    $(".open-window").on('click', function() {
        openWindow();
    })

    // close window when click button or cover
    $(".close-window, .black-cover").on('click', function() {
        closeWindow();
    })
});

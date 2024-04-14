var beverage = {};


function handleOrder(accept, o_id) {
    let data = {
        "o_id" : o_id,
        "accept" : accept,
    };
    $.post(
        "../php/handleOrder.php",
        data,
        (response, status) => {
            console.log(response);
            if (status == "success") {
                if (response["status"] == "success") {
                    showNotAcceptedOrders()
                }
            }
        }
    )
}

function showNotAcceptedOrders() {
    let data = {}
    $.post(
        "../php/getNotAcceptedOrders.php",
        data,
        (response, status) => {
            if (status == "success") {
                if (response["status"] == "success") {
                    let orders = response["data"];
                    $("#not-accepted-orders").empty();
                    for (let o_id in orders) {
                        $("#not-accepted-orders").append(`
                            <div class="card-body p-4">
                                <h5 class="center bold">❗待確認的訂單</h5>
                                <div class="card">
                                    <div class="card-header">
                                        訂單編號:${o_id}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6" id="beverage-${o_id}">
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="right">${orders[o_id]["time"]}</p>
                                                <br>
                                                <div class="down">
                                                    <label>總花費</label>
                                                    <label class="text-danger">$${orders[o_id]["cost"]}</label>
                                                    <button type="button" class="btn btn-primary" onclick="handleOrder('y', ${o_id})">接受</button>
                                                    <button type="button" class="btn btn-danger"  onclick="handleOrder('n', ${o_id})">拒絕</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `)
                        for (let order of orders[o_id]["orders"]) {
                            $(`#beverage-${o_id}`).append(`
                                <label>${order['b_name']}</label>
                                <label>(甜度:${order['sugar']} 冰塊:${order['ice']})</label>
                                <label> ($${order["price"]})</label>
                                *
                                <label><strong>${order['quantity']}</strong></label>
                                <br>
                            `)
                        }
                    }
                }
            }
        }
    )
}

function showInfo() {
    let data = {}
    $.post(
        "../php/getUserInfo.php",
        data,
        (response, status) => {
            if (status == "success") {
                if (response["status"] == "success") {
                    let minfor = response["data"];
                    $("#m_name").val(`${minfor["m_name"]}`);
                    $("#shop-photo").attr("src", `../static/img/${minfor["photo"]}`);
                    $("#address_city").val(minfor["address_city"]);
                    $("#address_district").val(minfor["address_district"]);
                    $("#address_detail").val(minfor["address_detail"]);
                    $("#m_phone").val(`${minfor["m_phone"]}`);
                    $("#manager_name").val(`${minfor["manager_name"]}`);
                    $("#manager_phone").val(`${minfor["manager_phone"]}`);
                    $("#opening_hours_start").val(convertTime(minfor["opening_hours_start"]));
                    $("#opening_hours_end").val(convertTime(minfor["opening_hours_end"]));
                    $("#delivery").val(`${minfor["delivery"]}`);
                }
            }
        }
    )
}
function updateMerchantInfo() {
    $.ajax({
        url : "../php/updateMerchantInfo.php",
        type : "POST",
        data : new FormData(document.getElementById("form-merchant-info")),
        contentType : false,
        cache : false,
        processData :false,
        beforeSend : function() {
            
        },
        success: function(data) {
            if (data["status"] == "success") {
                alert("修改成功");
                showInfo();
                document.getElementsByClassName("pre-scrollable")[0].scrollTop = 0
            }
        },
        error: function(e) {
            console.log(e);
        }          
    });
}

function addMenu() {
    let data = {
        "b_name" : $("#b_name").val(),
        "price" : $("#price").val(),
        "sugar" : $("#sugar-select").val(),
        "ice" : $("#ice-select").val(),
    }
    $.post(
        "../php/addMenu.php",
        data,
        (response, status) => {
            console.log(response);
            if (status == "success") {
                if (response["status"] == "success") {
                    alert("新增成功!");
                    window.location.reload();
                }
            }
        }
    )
}
function updateMenu(b_id) {
    let data = {
        "b_id" : b_id,
        "b_name" : $("#b_name").val(),
        "price" : $("#price").val(),
        "sugar" : $("#sugar-select").val(),
        "ice" : $("#ice-select").val(),
    };
    $.post(
        "../php/updateMenu.php",
        data,
        (response, status) => {
            if (status == "success") {
                if (response["status"] == "success") {
                    alert("修改成功");
                    window.location.reload();
                }
            }
        }
    )
}

function removeMenu(b_id) {
    let data = {
        "b_id" : b_id
    };
    $.post(
        "../php/removeMenu.php",
        data,
        (response, status) => {
            if (status == "success") {
                if (response["status"] == "success") {
                    alert("刪除成功");
                    window.location.reload();
                }
            }
        }
    )
}

function loadBeverageInfo(b_id) {
    $(".window button[onclick='addMenu()']").attr("onclick", `updateMenu(${b_id})`)
    $("#b_name").val(beverage[b_id]["b_name"]);
    $("#price").val(beverage[b_id]["price"]);
    let st = [];
    let it = [];
    for (let s of beverage[b_id]["sugar"]) {
        st.push(s["sugar_value"]);
    }
    for (let i of beverage[b_id]["ice"]) {
        it.push(i["ice_value"]);
    }
    $("#sugar-select").selectpicker('val', st);
    $("#ice-select").selectpicker('val', it);
    openWindow();
}

function showMenu() {
    let data = "";
    $.post(
        "../php/getMenu.php",
        data,
        (response, status) => {
            if (status == "success") {
                if (response["status"] == "success") {
                    let mmenu = response["data"];
                    console.log(mmenu);
                    $('#showmenu').html("");
                    if (mmenu.length == 0) {
                        $('.card-deck').html("<div><p>尚無菜單</p></div>");
                    }
                    else {
                        var html = "";
                        if (mmenu.length%4 == 0)    var menulen = mmenu.length/4;
                        else                        var menulen = ( mmenu.length - mmenu.length%4 ) / 4 + 1;
                        for (let i = 0; i<menulen; i++){
                            html += `<div class="card-deck">`;
                            for (let j = i*4 ; j < i*4+4 ; j++) {
                                if (j < mmenu.length){
                                    beverage[mmenu[j]["b_id"]] = {
                                        "b_name" : mmenu[j]["b_name"],
                                        "price" : mmenu[j]["price"],
                                        "sugar" : mmenu[j]["sugar"],
                                        "ice" : mmenu[j]["ice"],
                                    }
                                    html += (`
                                        <div class="card h-100 shadow border-0">
                                            <div class="card-header">
                                                <h4>${mmenu[j]["b_name"]}</h4>
                                            </div>
                                            <div class="card-body p-4">
                                                <div class="center">
                                                    <label>$${mmenu[j]["price"]}</label>
                                                    <br>
                                                    <select id="sugar-${mmenu[j]["b_id"]}">
                                                        <option value="999" selected>甜度選項</option>
                                                    </select>
                                                    <select id="ice-${mmenu[j]["b_id"]}">
                                                    <option value="999" selected>冰塊選項</option>
                                                    </select>
                                                    <br>
                                                    <br>
                                                    <button type="button" class="btn btn-primary open-window load-menu" id="update-${mmenu[j]["b_id"]}">編輯</button>
                                                    <button type="button" class="btn btn-danger" onclick="removeMenu(${mmenu[j]["b_id"]})">刪除</button>
                                                </div>
                                            </div>
                                        </div>
                                    `);
                                    let sugar = mmenu[j]["sugar"];
                                    let ice = mmenu[j]["ice"];
                                    setTimeout(
                                        function() {
                                            for (let k=0; k<sugar.length; k++) {
                                                $(`#sugar-${mmenu[j]["b_id"]}`).append(`
                                                    <option value="${sugar[k]["sugar_value"]}">${SUGAR[sugar[k]["sugar_value"]]}</option value="">
                                                `)
                                            }
                                            for (let k=0; k<ice.length; k++) {
                                                $(`#ice-${mmenu[j]["b_id"]}`).append(`
                                                    <option value="${ice[k]["ice_value"]}">${ICE[ice[k]["ice_value"]]}</option value="">
                                                `)
                                            }
                                        }, 10
                                    )
                                }
                                else{
                                    html += (`
                                        <div class="card h-100 shadow border-0"></div>
                                    `);
                                }
                                
                            }
                            html += `</div><br>`;
                            ($('#showmenu')).append(`${html}`);
                            html = "";
                        }
                    }
                    $(".load-menu").on('click', function() {
                        let b_id = $(this).prop("id").split("-")[1];
                        loadBeverageInfo(b_id);
                    })
                }
            }
        }
    )
}

function bindChangePage() {
    var prebtn  = document.querySelector('#prebtn');
    var nextbtn = document.querySelector('#nextbtn');

    prebtn.addEventListener("click", function () {
        var nowpage =  parseInt($('#btn1 > a').text(), 10);
        if (nowpage > 1){
            console.log("prebtn in");
            nowpage = nowpage - 1;
            changeComment(nowpage,large);
        }
    })
    nextbtn.addEventListener("click", function () {
        var nowpage =  parseInt($('#btn1 > a').text(), 10);
        if (nowpage < largepage){
            console.log("nextbtn in",nowpage,largepage);
            nowpage = nowpage + 1;
            changeComment(nowpage,large);
        }
    })
}
function showComment() {
    $.post(
        "../php/getComment.php",
        "",
        (response, status) => {
            if (status == "success") {
                if (response["status"] == "success") {
                    let comment = response["data"];
                    if (comment.length == 0) {
                        $('#show-mer-com').append(`
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="card h-100 shadow border-0">
                                        <div class="card-title p-4">
                                            還沒有評價喔!
                                        </div>
                                        <div class="card-body p-4">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        `)
                    }
                    else {
                        comment.sort(sortdate).reverse()    //sort by datetime
                        
                        var largepage;              //count the length of comment length
                        var large = comment.length; //the length of comment
                
                        if (comment.length%10 != 0) largepage = (comment.length - comment.length%10)/10+1;
                        else                        largepage = comment.length/10;
                        changeComment(1,comment.length);
                        
                    }
                    bindChangePage();
                    function changeComment(now , large){
                        // console.log(now,large);
                        $('#btn1 > a').text(now);
                        $('#show-mer-com').html(``);
                    
                        html = "";       //to show html on merchant comment
                    
                        for (let i = (now-1)*10 ; i < now*10 && i < large ; i++) {
                            $('#show-mer-com').append(`
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-8">
                                        <div class="card h-100 shadow border-0">
                                            <div class="card-title p-4">
                                                ${comment[i]["u_name"]}
                                            </div>
                                            <div class="card-body p-4">
                                                <p class="comment-content">${comment[i]["content"]}</p>
                                                <br>
                                                <div class="stars">
                                                    <form action="">
                                                        <input class="star star-5" id="star-5-${i}" type="radio" name="star" value="5">
                                                        <label class="star star-5" for="star-5-${i}"></label>
                                                        <input class="star star-4" id="star-4-${i}" type="radio" name="star" value="4">
                                                        <label class="star star-4" for="star-4-${i}"></label>
                                                        <input class="star star-3" id="star-3-${i}" type="radio" name="star" value="3">
                                                        <label class="star star-3" for="star-3-${i}"></label>
                                                        <input class="star star-2" id="star-2-${i}" type="radio" name="star" value="2">
                                                        <label class="star star-2" for="star-2-${i}"></label>
                                                        <input class="star star-1" id="star-1-${i}" type="radio" name="star" value="1">
                                                        <label class="star star-1" for="star-1-${i}"></label>
                                                    </form>
                                                </div>
                                                <small class="form-text text-muted">${comment[i]["time"]}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div><br>
                            `)
                    
                            $(`input[name="star"][id=star-${comment[i]["stars"]}-${i}]`).prop("checked", true)
                        }
                    }
                }
            }
        }
    )
}

function linkPage() {
    let cookies = getCookies();
    let m_id = cookies["id"];
    $("#link-shop-page").prop("href", `../shop?m_id=${m_id}`)
}

function bar(ctx, labels, data, color) {
    let barChart = new Chart(ctx, {
        type : "bar",
        data : {
            labels : labels,
            datasets : [{
                label : "vote",
                data: data,
                backgroundColor : color,
                borderWidth: 1
            }]
        }
    });
}

function pie(ctx, labels, data, color) {
    let pieChart = new Chart(ctx, {
        type : 'pie',
        data : {
        labels : labels,
        datasets : [{
            data : data,
            backgroundColor : color,
        }],
        }
    });
}


$(document).ready(function () {
    // show not accrpted orders
    showNotAcceptedOrders();

    // change merchant discount
    // for (let i=0;i<mdiscount.length;i++){
    //     ($('#v-pills-discount > div.container-fluid > div.row > div.col-sm-8 > form > div.h-100 > div.card-body')).append(`
    //         <div class="card border-dark">
    //             <div class="card-body p-4">
    //                 <input type="checkbox">
    //                 <a class="text-decoration-none link-dark" href="#!" target="_blank"><label>${mdiscount[i]["disname"]}</label></a>
    //             </div>
    //         </div>
    //         <br>
    //     `)
    // }

    //change merchant information
    showInfo();

    // save merchant information
    $("#save").on("click", function() {
        updateMerchantInfo();
    })

    //change merchant menu
    showMenu();

    // show comment record
    showComment();

    // link of shop page
    linkPage();
});
order = [
    {
        'o_id':'1',
        'c_id':'3',
        'm_id':'6',
        'order_time':'2022-04-02 07:46:23',
        'is_accepted': false ,
        'accepted_time':'0000-00-00',	
        'canceled_time'	:'2022-04-02 07:46:53',
        'price': '100'
    },
    {
        'o_id':'2',
        'c_id':'3',
        'm_id':'6',
        'order_time':'2022-04-02 15:05:13',
        'is_accepted': false,	
        'accepted_time':'2022-04-02 15:05:43',	
        'canceled_time'	:'0000-00-00',
        'price': '120'
    },
    {
        'o_id':'3',
        'c_id':'2',
        'm_id':'4',
        'order_time':'2022-04-03 13:33:49',
        'is_accepted': true,	
        'accepted_time':'2022-05-03 13:34:19',	
        'canceled_time'	:'0000-00-00',
        'price': '200'
    },
    {
        'o_id':'4',
        'c_id':'2',
        'm_id':'6',
        'order_time':'2022-05-04 09:37:13',
        'is_accepted': true,	
        'accepted_time':'2022-05-04 09:37:43',	
        'canceled_time'	:'0000-00-00',
        'price': '50'
    },
    {
        'o_id':'5',
        'c_id':'2',
        'm_id':'5',
        'order_time':'2022-05-06 10:17:18',
        'is_accepted': true,	
        'accepted_time':'2022-05-06 10:17:48',	
        'canceled_time'	:'0000-00-00',
        'price': '105'
    },
    {
        'o_id':'6',
        'c_id':'1',
        'm_id':'5',
        'order_time':'2022-05-06 10:17:18',
        'is_accepted': true,	
        'accepted_time':'2022-05-06 10:17:48',	
        'canceled_time'	:'0000-00-00',
        'price': '120'
    },
    {
        'o_id':'7',
        'c_id':'3',
        'm_id':'5',
        'order_time':'2022-05-13 06:37:15',
        'is_accepted': true,	
        'accepted_time':'2022-05-13 06:37:45',
        'canceled_time'	:'0000-00-00',
        'price': '305'
    },
    {
        'o_id':'8',
        'c_id':'3',
        'm_id':'4',
        'order_time':'2022-05-14 19:18:24',
        'is_accepted': true,	
        'accepted_time':'2022-05-14 19:18:54',
        'canceled_time'	:'0000-00-00',
        'price': '550'
    },
    {
        'o_id':'9',
        'c_id':'2',
        'm_id':'6',
        'order_time':'2022-05-16 17:52:39',
        'is_accepted': true,	
        'accepted_time':'2022-05-16 17:53:09 ',
        'canceled_time'	:'0000-00-00',
        'price': '360'
    },
    {
        'o_id':'10',
        'c_id':'3',
        'm_id':'4',
        'order_time':'2022-05-17 10:39:34',
        'is_accepted': null,	
        'accepted_time':'2022-05-17 10:40:04 ',	
        'canceled_time'	:'0000-00-00',
        'price': '953'
    },
    {
        'o_id':'11',
        'c_id':'2',
        'm_id':'6',
        'order_time':'2022-05-18 23:12:26',
        'is_accepted': false,
        'accepted_time':'0000-00-00 ',
        'canceled_time'	:'2022-05-18 23:12:56',
        'price': '150'
    }
]

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

// function showChart() {
//     //show chart

//     var stime = new Date('2021-12-02');
//     var etime = new Date('2022-05-01');
//     var month = ( etime.getMonth() - stime.getMonth() ) + 1 + ( 12 * ( etime.getFullYear() - stime.getFullYear() ) ); //show the length of month
//     // console.log(month);
    
//     //依照月份畫長條圖
//     var o_amount = new Array();  //訂單數量
//     var o_price  = new Array();  //訂單總額

//     //全部時間的累積畫圓餅圖
//     var o_accept  = new Array();  //接受訂單數量
//     var o_cancel  = new Array();  //拒絕訂單數量
//     var o_pending = new Array();  //等待訂單數量

//     //initialize
//     for (let i = 0 ; i < month ; i ++ ){
//         o_amount[i] = 0;
//         o_price [i] = 0;
//         o_accept[i] = 0;
//         o_cancel[i] = 0;
//         o_pending[i]= 0;
//     }

    
//     for (let i = 0 ; i < order.length ; i++ ){
//         var times = ( (new Date(order[i]['order_time'])).getMonth() - stime.getMonth() ) + ( 12 * ( (new Date(order[i]['order_time'])).getFullYear() - stime.getFullYear() ) );

//         o_amount[times] = o_amount[times] + 1;
//         o_price [times] = o_price [times] + parseInt(order[i]['price']);
//         if ( order[i]['is_accepted'] === null ){
//             o_pending[times]= parseInt(o_pending[times]) + 1;
//         }
//         else if ( order[i]['is_accepted'] == true ){
//             o_accept[times] = parseInt(o_accept[times]) + 1;
//         }
//         else{
//             o_cancel[times] = parseInt(o_cancel[times]) + 1;
//         }
//     }
//     console.log(o_amount);
//     console.log(o_price);
//     console.log(o_accept);
//     console.log(o_cancel);


//     let color = ["#FF0000", "#00FF00", "#0000FF"];




//     //set labels
//     let labels = [];
//     var syear  = stime.getFullYear();
//     var eyear  = etime.getFullYear();
//     var smonth = stime.getMonth()+1;
//     var emonth = etime.getMonth()+1;

//     // console.log(syear,eyear,smonth,emonth);

//     while ( !((syear == eyear && smonth == emonth+1)) ){
//         labels.push( syear + '/' + smonth );
//         smonth = smonth+1;
//         if (smonth == 13){
//             syear  = syear + 1;
//             smonth = 1;
//         }
//     }



//     console.log(labels);


//     let ctxBarAomunt = document.getElementById("canvas-bar-amount").getContext('2d');
//     bar(ctxBarAomunt, labels, o_amount, color)

//     let ctxBarPrice = document.getElementById("canvas-bar-price").getContext('2d');
//     bar(ctxBarPrice, labels, o_price, color)

//     let ctxPieAccept = document.getElementById('canvas-pie-accept').getContext('2d');
//     pie(ctxPieAccept, labels, o_accept, color)

//     let ctxPieCancel = document.getElementById('canvas-pie-cancel').getContext('2d');
//     pie(ctxPieCancel, labels, o_cancel, color)

//     let ctxPiePending= document.getElementById('canvas-pie-pending').getContext('2d');
//     pie(ctxPiePending, labels, o_pending, color)
// }


function showOrders() {
    let url = window.location.href;
    let o_id, startDate, endDate;
    if (url.includes("o_id")) {
        o_id = url.split("?o_id=")[1];
    }
    else if (url.includes("sd") && url.includes("ed")) {
        let tmp = url.split("?")[1].split("&");
        startDate = tmp[0].split("=")[1];
        endDate = tmp[1].split("=")[1];
    }
    let data = {
        "o_id" : o_id,
        "startDate" : startDate,
        "endDate" : endDate,
    };
    $.post(
        "../php/getOrders.php",
        data,
        (response, status) => {
            if (status == "success") {
                if (response["status"] == "success") {
                    let orders = response["data"];
                    console.log(orders);
                    for (let order of orders) {
                        let status;
                        if (order["order"]["is_accepted"]=='Y' || order["order"]["is_accepted"]=='y') {
                            status = `已接受 (${order["order"]["accepted_time"]})`;
                        }
                        else if (order["order"]["is_accepted"]=='N' || order["order"]["is_accepted"]=='n') {
                            status = "被棄單";
                        }
                        else {
                            status = "未處理";
                        }
                        $("#order-content").append(`
                        <div class="row">  
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <div class="card h-100 shadow border-0">
                                    <div class="card-body p-4"> 
                                        <label>編號：</label>
                                        <label>${order["order"]["o_id"]}</label>
                                        <br>
                                        <label>店家：</label>
                                        <label>${order["order"]["m_name"]}</label>
                                        <br>
                                        <label>品項：</label>
                                        <div id="item-${order["order"]["o_id"]}"></div>
                                        <br>
                                        <label>狀態：</label>
                                        <label>${status}</label>
                                        <br>
                                        <label>時間：</label>
                                        <label>${order["order"]["order_time"]}</label> 
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        `)
                        for (let detail of order["orderDetail"]) {
                            $(`#item-${order["order"]["o_id"]}`).append(`
                                <label>${detail["b_name"]} (${SUGAR[detail["sugar"]]}, ${ICE[detail["ice"]]}) ($${detail["price"]}) * <span class="text-danger">${detail["quantity"]}</span></label>
                                <br>
                            `)
                        }
                    }
                }
            }
        }
    )
}

$(document).ready(function () {
    // show orders
    showOrders();

});

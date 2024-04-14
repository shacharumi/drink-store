function show6Shops() {
    let data = {}
    $.post(
        "../php/getHot.php",
        data,
        (response, status) => {
            if (status == "success") {
                if (response["status"] == "success") {
                    let hot = response["data"];
                    console.log(hot)
                    for (let i=0 ; i<2; i++){
                        $("#6-shops-info").append(`
                        <div class="row top" id="row-${i}">
                        </div>
                        `);
                        for (let j=0; j<3; j++) {
                            let idx = i*3 + j;
                            $(`#row-${i}`).append(`
                            <div class="col-sm-4">
                                <div class="card h-100 shadow border-0">
                                    <img class="card-img-top cover" src="../static/img/${hot[idx]["info"]["photo"]}" alt="..." />
                                    <div class="card-body p-4">
                                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                        <a class="text-decoration-none link-dark stretched-link" href="../shop?m_id=${hot[idx]["info"]["m_id"]}">
                                            <div class="h3 card-title mb-3">${hot[idx]["info"]["m_name"]}</div>
                                        </a>
                                        <p class="card-text mb-0">${hot[idx]["info"]["address_city"]} ${hot[idx]["info"]["address_district"]} ${hot[idx]["info"]["address_detail"]}</p>
                                        <p class="card-text mb-0">
                                        熱銷👉🏻一定是
                                        <span class="text-danger h5">${hot[idx]["hot"]}</span>
                                        啦
                                        </p>
                                    </div>
                                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                        <div class="d-flex align-items-end justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <p>評論：</p>
                                                <br>
                                                <div class="small">
                                                    <p class="card-text mb-0">${hot[idx]["comments"][0]["content"]}</p>
                                                    <p class="card-text mb-0">${hot[idx]["comments"][1]["content"]}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                        }
                    }
                }
            }
        }
    )
    
}

$(document).ready(function(){
    // show 6 shops
    show6Shops();

})
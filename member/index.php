<?php

session_start(); 
require("../php/User.php");
if (!User::check()) {
    header("Location: ../");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeverageShop</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- date picker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="../static/js/app.js"></script>
    <script src="../static/js/member.js"></script>
    <link href="../static/css/member.css" rel="stylesheet">
    <link href="../static/css/base.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/app.css">
</head>

<body class="over">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="../static/img/bootstrap-solid.svg" width="auto" height="30" alt="">
        <a class="navbar-brand" href="../">everageShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">


            <form action="" method="get" class="form-inline navbar-nav pl-0 mr-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

            <ul class="navbar-nav ml-auto">

                <?php if(!empty($_COOKIE) && !empty($_COOKIE["type"])): ?>
                <ul class="navbar-nav mr-auto">
                    <?php if($_COOKIE["type"] == "customer"): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../member">會員專區</a>
                    </li>
                    <?php elseif($_COOKIE["type"] == "merchant"): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../merchant">商家後臺</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>

                <?php if(User::check()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="../php/logout.php">Logout</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="../register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- 會員專區 -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 bg-light sidebar">
                <div class="nav flex-column nav-pills nav-fill" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <h3 class="nav_title">選單</h3>
                    <a class="nav-link sidebar_font center active" id="v-pills-profile-tab" data-toggle="pill"
                        href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="True">個人資料</a>
                    <a class="nav-link sidebar_font center" id="v-pills-love-tab" data-toggle="pill"
                        href="#v-pills-love" role="tab" aria-controls="v-pills-love" aria-selected="false">最愛店家</a>
                    <a class="nav-link sidebar_font center" id="v-pills-record-tab" data-toggle="pill"
                        href="#v-pills-record" role="tab" aria-controls="v-pills-record" aria-selected="false">訂單紀錄</a>
                    <a class="nav-link sidebar_font center" id="v-pills-comment-tab" data-toggle="pill"
                        href="#v-pills-comment" role="tab" aria-controls="v-pills-comment"
                        aria-selected="false">評價紀錄</a>
                </div>
            </div>

            <div class="col-sm-10 pre-scrollable high">
                <div class="tab-content" id="v-pills-tabContent">
                    <!--個人資料-->
                    <div class="form-group tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <form action="" method="post">
                            <label class="title">😀個人資料</label>
                            <br>
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" name="username" id="username">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" id="email">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" id="name">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" name="phone" id="phone">
                            </div>
                            <br>
                            <div class="center">
                                <button type="button" class="btn btn-primary" id="save">儲存變更</button>
                            </div>
                        </form>
                    </div>

                    <!--訂單記錄-->
                    <div class="tab-pane fade" id="v-pills-record" role="tabpanel" aria-labelledby="v-pills-record-tab">
                        <div>
                            <label class="title">📋訂單紀錄</label>
                            <div>
                                <form method="GET" action="../php/date_order.php" class="title ">
                                    <label>🔎透過日期搜尋訂單</label>
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="row">
                                                <div class="col-1">
                                                    <label>起</label>
                                                </div>
                                                <div class="col-11">
                                                    <div class="input-group date" id='s_datepicker'>
                                                        <input type="date" name='s_datepicker' class="form-control" id="startDate" />
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="row">
                                                <div class="col-1">
                                                    <label>迄</label>
                                                </div>
                                                <div class="col-11">
                                                    <div class="input-group date" id='e_datepicker'>
                                                        <input type="date" name='e_datepicker' class="form-control" id="endDate" />
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary" onclick="searchOrder('date')">搜尋</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div>
                            <form method="GET" action="../php/getOrderById.php" class="top title">
                                <label>🔎透過編號搜尋訂單</label>
                                <div class="row">
                                    <div class="col">
                                        <input name="order-id" id="order-id" type="text" placeholder="請輸入訂單編號" class="form-control mx-sm-2">
                                    </div>

                                    <div class="col">
                                        <button type="button" class="btn btn-primary" onclick="searchOrder('id')">搜尋</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--最愛店家-->
                    <div class="tab-pane fade" id="v-pills-love" role="tabpanel" aria-labelledby="v-pills-love-tab">
                        <label class="title">❤️最愛店家</label>

                        <div class="list-group">
                        </div>
                    </div>

                    <!--評價-->
                    <div class="tab-pane fade" id="v-pills-comment" role="tabpanel"
                        aria-labelledby="v-pills-comment-tab">
                        <label class="title">📝評價紀錄</label>
                        <div class="container-fluid ">
                            <div id = "show-mem-com">
                            </div>
                            <div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous" id="prebtn">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li class="page-item" id="btn1"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next" id="nextbtn">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
                <br><br><br><br><br>
            </div>
        </div>
    </div>
</body>

</html>
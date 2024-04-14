<?php

session_start(); 
require("../php/User.php");

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
    <script src="../static/js/shop.js"></script>
    <link href="../static/css/base.css" rel="stylesheet">
    <link href="../static/css/shop.css" rel="stylesheet">
    <link href="../static/css/app.css" rel="stylesheet">
</head>

<body>
    <!-- 飲料店頁面 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="../static/img/bootstrap-solid.svg" width="auto" height="30" alt="">
        <a class="navbar-brand" href="../">everageShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">


            <form action="../search" method="get" class="form-inline navbar-nav pl-0 mr-auto">
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

    <header class="bg-dark py-3">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2" id="m_name"></h1>
                        <label class="lead fw-normal text-white" id="address"></label>
                        <br>
                        <label class="lead fw-normal text-white" id="m_phone"></label>
                        <br>
                        <label class="lead fw-normal text-white">🕙營業時間:</label>
                        <label class="lead fw-normal text-white" id="time"></label>
                        <br>
                        <label class="lead fw-normal text-white">🛵外送:</label>
                        <label class="lead fw-normal text-white" id="deilvery"></label>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                    <img class="img-fluid rounded-3 my-5 cover" src="../static/img/default.jpg" alt="shop photo" id="shop-photo">
                </div>
            </div>
        </div>
    </header>


    <!-- <div class="center top">
        <h1>💥現正優惠中</h1>
    </div> -->

    <div class="container-fluid">
        <!-- 菜單 -->
        <div class="center top">
            <h1>🧃菜單</h1>
        </div>
        <div class="row top">
            <div class="col-sm-2"></div>
            <div class="col-sm-8"></div>
            <div class="col-sm-2"></div>
        </div>
        <!-- 購物車 -->
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div>
                        <div class="card h-100 shadow border-0">
                            <div class="card-body p-4">
                                <h5 class="center bold">購物車</h5>
                                <div class="card">
                                    <div class="card-header">
                                        訂單
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6" id="cart">
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="down">
                                                    <label>總花費</label>
                                                    <label>$</label>
                                                    <label class="text-danger h4 total-cost">0</label>
                                                    <br>
                                                    <button type="button" class="btn btn-primary open-window">結帳</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
        <div class="black-cover"></div>
        <div class="window bg-light top-50">
            <form method="post">
                <br>
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="my-name">姓名</label>
                        <input type="text" class="form-control" id="my-name" name="my-name" value="">
                    </div>
                    <div class="form-group">
                        <label for="my-phone">電話</label>
                        <input type="text" class="form-control" id="my-phone" name="my-phone" value="">
                    </div>
                    <div class="form-inline right">
                        <label class="price">$</label>
                        <label class="text-danger h4 total-cost">0</label>
                        <div class="pl-1">
                            <button type="button" class="btn btn-secondary close-window">取消</button>
                        </div>
                        <div class="pl-1">
                            <button type="button" class="btn btn-primary" onclick="submitOrder()">送出</button>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
            </form>
        </div>

        <!-- 評價 -->
        <div class="center top">
            <h1>📝填寫評價</h1>
        </div>
        <div class="row top">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="card shadow border-0" id="com-show">
                    <div class="card-body p-4">
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-12">
                                    <div class="stars">
                                        <form action="">
                                            <input class="star star-5" id="star-5-give" type="radio" name="star-give" value="5">
                                            <label class="star star-5" for="star-5-give"></label>
                                            <input class="star star-4" id="star-4-give" type="radio" name="star-give" value="4">
                                            <label class="star star-4" for="star-4-give"></label>
                                            <input class="star star-3" id="star-3-give" type="radio" name="star-give" value="3">
                                            <label class="star star-3" for="star-3-give"></label>
                                            <input class="star star-2" id="star-2-give" type="radio" name="star-give" value="2">
                                            <label class="star star-2" for="star-2-give"></label>
                                            <input class="star star-1" id="star-1-give" type="radio" name="star-give" value="1">
                                            <label class="star star-1" for="star-1-give"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row top">
                                <div class="col-sm-10">
                                    <textarea type="text" id="content" name="content" class="form-control" placeholder="填寫評價" required></textarea>
                                </div>
                                <div class="col-sm-2">
                                    <button id="comment-submit" class="btn btn-md btn-primary btn-block" type="button" onclick="giveComment()">提交</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card"></div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <br>
    </div>
</body>

</html>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <link href="../static/css/base.css" rel="stylesheet">
    <link href="../static/css/search.css" rel="stylesheet">
</head>
<body>
    <!-- 搜尋結果 -->
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

    <div class="container-fluid " >
        <div class="row top">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="card h-100 shadow border-0">
                    <img class="card-img-top cover" src="../static/img/default.jpg" alt="..."  />
                    <div class="card-body p-4">
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>                        
                        <a class="text-decoration-none link-dark stretched-link" href="#!"><div class="h3 card-title mb-3">IGEN 咖啡屋</div></a>
                        <p class="card-text mb-0">高雄市鳳山區勳哥路87號</p>
                        <p class="card-text mb-0">熱銷->一定是原萃啦</p>     
                    </div>
                    
                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                        <div class="d-flex align-items-end justify-content-between">
                            <div class="d-flex align-items-center">
                                <p>評論：</p>
                                <div class="small">
                                    <p class="card-text mb-0">竣任喝過都說好</p>
                                    <p class="card-text mb-0">一定是大拇指的啦</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>  
            </div>

            <div class="col-sm-4">
   
            <div class="card h-100 shadow border-0">
                    <img class="card-img-top cover" src="../static/img/default.jpg" alt="..."  />
                    <div class="card-body p-4">
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>                        
                        <a class="text-decoration-none link-dark stretched-link" href="#!"><div class="h3 card-title mb-3">IGEN 咖啡屋</div></a>
                        <p class="card-text mb-0">高雄市鳳山區勳哥路87號</p>
                        <p class="card-text mb-0">熱銷->一定是原萃啦</p>     
                    </div>
                    
                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                        <div class="d-flex align-items-end justify-content-between">
                            <div class="d-flex align-items-center">
                                <p>評論：</p>
                                <div class="small">
                                    <p class="card-text mb-0">竣任喝過都說好</p>
                                    <p class="card-text mb-0">一定是大拇指的啦</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
    
    
    
    
    
    
    
                        

                        
</body>
</html>
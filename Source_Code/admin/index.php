<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- STYLE-->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        @media only screen and (max-width: 750px) {
          .container>.row>div {
            margin-bottom: 1rem;
          }
        }
    </style>

</head>
<body style="background-color: #1a2035;">
    <div class="wrapper">
        <?php
            include_once('sidebar.php');
        ?>

            <div class="main-content" style="width: 100%;" onclick="w3_close()">
                <div class="navbar">
                    <h2>Trang Chủ</h2>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card one">
                                <div class="card-tittle money">Tổng sản phẩm</div>
                                <div class="chart">
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    <div class="num">1000000</div>
                                 </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card two">
                                <div class="card-tittle book">Số người truy cập</div>
                                <div class="chart">
                                    <i class="fa fa-area-chart" aria-hidden="true"></i>
                                    <div class="num">10</div>
                                 </div>
                            </div>
                        </div>
                            
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card three">
                                <div class="card-tittle using">Số khách hàng liên hệ</div>
                                <div class="chart">
                                    <i class="fa fa-area-chart" aria-hidden="true"></i>
                                    <div class="num">10</div>
                                 </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card four">
                                <div class="card-tittle viewer">Khách hàng đăng kí lái thử </div>
                                <div class="chart">
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    <div class="num">2500</div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function w3_open() {
            document.getElementById("main").style.marginLeft = "17%";
            document.getElementById("mySidebar").style.width = "17%";
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("list").style.display = 'none';
            }
        function w3_close() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("list").style.display = 'inline-grid';
        }

    </script>
</body>
</html>
<?php
  require_once('conn.php');
  $getHang = getHang();
  if ($getHang['code'] == 0) {
    $thongtinhang = $getHang['result'];
  }
  $getSanpham = getNewProduct();
  if ($getSanpham['code'] == 0) {
    $thongtinsp = $getSanpham['result'];
  }
  $getBestSeller = getBestSeller();
  if ($getBestSeller['code'] == 0) {
    $bestseller = $getBestSeller['result'];
  }

  $getInfo = getInfoWeb();
  if ($getInfo['code'] == '0') {
    $infoWeb = $getInfo['result'];
    $info = $infoWeb->fetch_assoc();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Vua 4 bánh</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" rel="stylesheet"/>

  <!-- STYLE-->
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <!-- Navigation -->
 <?php
  include_once('nav.php');
  ?>

  <!-- Page Content -->
  <section id="head_page">
    <div class="row">
      <div class="col-md-8 col-sm-12 col-lg-8 col-12">
        <div class="banner">
          <img src="uploads/<?= $info['anhlon'] ?>" alt="">
        </div>
      </div>

      <div class="col-sm-12 col-lg-4 d-none d-md-block">
        <div class="banner">
          <div class="small-banner">
            <div class="child-banner">
              <img src="uploads/<?= $info['anhnho1'] ?>" alt="">
            </div>
          </div>

          <div class="small-banner">
            <div class="child-banner">
              <img src="uploads/<?= $info['anhnho2'] ?>" alt="">
            </div>
          </div> 
        </div> 
      </div>
    </div>

    <div class="row">
    <?php
      while ($row =$thongtinhang->fetch_assoc()) {
      ?>
      <div class="col-6 col-md-2 col-sm-6 col-lg-2 logo-brand border mt-2">
        <a class="" title="" target="_self" href="product.php?mahang=<?=$row['mahang'] ?>" style="padding: 15px;"><img src="<?=$row['logo'] ?>" title="" alt="" class="" style="height:50px;"></a>
      </div>
      <?php
      }
    ?>
    <div class="col-lg-4 col-md-4 d-none d-md-block">
        <div id="search" style="width: 100%;">
        <form class="form-inline" method="post" action="product.php">
          <div class="form-group">
            <input style="width: 100%;margin-right: 0;" id="nav-search" value="" name="nav-search"class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm"> 
          </div>
          <div class="form-group"><button class="btn" name="btn-nav-search" type="submit">Tìm kiếm</button></div>
        </form>
        </div>
      </div>
      <div class="col-12 col-sm-12 d-md-none d-block bg-danger d-flex justify-content-center mt-4">
        <h1>HOTLINE: <?= $info['sdt'] ?></h1>
      </div>
    </div>
  </section>

  <section>
    <div class="new-products">
      <span class="mb-2"></span>
      <h3><span>Sản phẩm mới</span></h3>
      <div class="row show-new-products">
        <?php
        foreach ($thongtinsp as $row){
        ?>
        <div class="col-6 col-md-3 col-sm-6 col-lg-3">
          <a href="chitiet.php?id=<?=$row['id']?>">
            <div class="card">
              <div class="show-img-product">
                <img src="uploads/<?=$row['img'] ?>" class="product-image">
              </div>
              <div class="card-title">
                <h6><?=$row['tensp']?></h6>                      
              </div>
              <div class="card-body">
                <div class="add">
                  <button type="button" class="btn btn-danger btn-add">XEM CHI TIẾT</button>
                </div>
              </div>
            </div>
          </a>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </section>

  <section>
  <?php
  if (!empty($bestseller)) {
  ?>
    <div class="new-products">
      <span class="mb-2"></span>
      <h3><span>Sản phẩm bán chạy nhất</span></h3>
      <div class="row show-new-products">
      <?php
        while ($row = $bestseller->fetch_assoc()){
      ?>
          <div class="col-md-3 col-sm-6 col-lg-3">
            <div class="card">
              <div class="show-img-product">
                <img src="uploads/<?= $row['img'] ?>" class="product-mage">
              </div>
              <div class="card-title">
                <h6> <?= $row['tensp'] ?> </h6>                      
              </div>
              <div class="card-body">
                <p class="product-price"></p>
                <div class="add">
                  <button type="button" class="btn btn-danger btn-add">XEM CHI TIẾT</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  <?php
    }
  }
  ?>
  </section>

  <div class="modal" id="infoModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Đăng kí lái thử</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="pwd">Họ tên:</label>
            <input type="text" class="form-control" placeholder="Nhập họ tên" id="hoten">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" placeholder="Nhập email" id="email">
          </div>

          <div class="form-group">
            <label for="email">Số điện thoại:</label>
            <input type="text" class="form-control" placeholder="Nhập số điện thoại" id="sdt">          
          </div>

          <div class="form-group">
            <label for="hang">Chọn hãng xe:</label>
            <select class="form-control" id="hang">
              <option value="-1" selected disabled="">--Chọn hãng xe--</option>
            </select>
          </div>

          <div class="form-group">
            <label for="loaixe">Chọn loại xe:</label>
            <select hidden style="text-transform: uppercase;" class="form-control" id="loaixe">
            </select>
          </div>

          <div class="form-group">
            <label for="mauxe">Mẫu xe:</label>
            <select hidden class="form-control" id="mauxe">    
            </select>
          </div>

          <div hidden id="show-error" class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </button>
            <p id="msg-error"></p>
          </div>
          <button id="btn-dangkilaithu" type="button" class="btn btn-primary">Đăng kí lái thử</button>
        </div>

      </div>
    </div>
  </div>

    <!--MODAL MENU-->
  <div id="modalMenu" class="modal fixed-right fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-aside" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">KỶ NGUYÊN BỐN BÁNH</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-2 col-12 col-sm-12">
              <form class="form-inline" method="post" action="product.php">
                <div class="form-group">
                  <input style="width: 90%;margin-right: 1rem;" id="nav-search" value="" name="nav-search"class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm">          
                </div>

                <div class="form-group">
                  <button class="btn" style="background-color: #3C1A5B;color: #FFFF00;font-weight: 700;" name="btn-nav-search" type="submit">Tìm kiếm</button>
                </div>
              </form>
            </div>

            <div class="col-12 col-sm-12">
              <ul class="menu-modal">
                <?=createModalMenu(); ?>
              </ul>         
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--SIDE-NAV-->
  <div id="mySidenav" class="sidenav">
    <a href="#" data-toggle="modal" data-target="#infoModal" id="about"><i class="fa fa-automobile"></i> Đăng kí lái thử</a>
    <a href="#" data-toggle="modal" data-target="#lienhetuvanModal" id="blog"><i class="fa fa-commenting"> </i> Liên hệ tư vấn</a>
    <a href="#" id="projects"><i class="fa fa-facebook-official"></i> Nhắn tin qua FB</a>
    <a href="#" id="contact"><i class="fa fa-phone"></i> Yêu cầu gọi lại</a>
  </div>
  <!-- Footer -->
  <?php
    include_once('footer.php');
    include_once('lienhetuvan.php');
  ?>
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="main.js"></script>
  <script>
    $(document).ready(function() {
      $('#infoModal').modal('show');
    })
  </script>
</body>
</html>

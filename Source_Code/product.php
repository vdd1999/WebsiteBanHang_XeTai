<?php 
  require_once('conn.php');
  $error = "";

  //Nếu có sự kiện search
  if (isset($_POST['btn-nav-search'])) {
    if (!empty($_POST['nav-search'])) {
      $s = $_POST['nav-search'];
      $result = searchProduct($s);
      if ($result['code'] == '0') {
        $data = $result['result'];
        if (isset($result['tenhang'])) {
          $tenhang = $result['tenhang'];
        }
      }
      else {
        $error = $result['msg'];
      }
    }
    else {
      $error = "Vui lòng nhập từ khóa cần tìm";
    }
  }

  else if (isset($_GET['mahang']) && isset($_GET['loaixe'])){
    $mahang = $_GET['mahang'];
    $maloaixe = $_GET['loaixe'];
    $result = getProductbyBranchandBrand($mahang,$maloaixe);
    if ($result['code'] == '0') {
      $data = $result['result'];
      $gettenhang = getNamebyMahang($mahang);
      $gettenloai = getNameBrand($maloaixe);
      if ($gettenhang['code'] == '0' && $gettenloai['code'] == '0') {
        $tenhang = $gettenhang['result'].' - '.$gettenloai['result'];
      }
      else {
        $error = $gettenhang['msg'];
      }
    }
    else {
      $error = $result['msg'];
    }
  }

  else if (isset($_GET['mahang'])) {
    $mahang = $_GET['mahang'];
    $result = getProductbyBranch($mahang);
    if ($result['code'] == '0') {
      $data = $result['result'];
      $gettenhang = getNamebyMahang($mahang);
      $gettenhang['code'];
      if ($gettenhang['code'] == '0') {
        $tenhang = $gettenhang['result'];
      }
      else {
        $error = $gettenhang['msg'];
      }
    }
    else {
      $error = $result['msg'];
    }
  }

  else if (isset($_GET['loaixe'])) {
    $maloaixe = $_GET['loaixe'];
    $result = getProductbyBrand($maloaixe);
    if ($result['code'] == '0') {
      $data = $result['result'];
      $gettenloai = getNameBrand($maloaixe);
      if ($gettenloai['code'] == '0') {
        $tenhang = $gettenloai['result'];
      }
      else {
        $error = $gettenloai['msg'];
      }
    }
    else {
      $error = $result['msg'];
    }
  }
  else {
    $error = "Không có sản phẩm";
  }
  $getHang = getHang();
  if ($getHang['code'] == 0) {
    $thongtinhang = $getHang['result'];
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
  <!-- STYLE-->
  <link rel="stylesheet" href="style.css" />
</head>

<body id=product>
  <!-- Navigation -->
<?php
  include_once('nav.php');
?>
  <!-- Page Content -->
  <section id="head_page">
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
    </div>
  </section>
  <div class="show-cate">
    <div class="row">
<!--       <div class="xs-menu d-md-none">
        <button type="button" data-toggle="modal" data-target="#modalMenu" class="btn btn-info">
            <i class="fa fa-align-justify"></i>
        </button>
      </div> -->

      <div class="col-lg-2 col-md-2 d-none d-md-block">
        <div class="category">
          <ul class="menu">
            <li class="dropright">
              <a href="">DANH MỤC SẢN PHẨM</a>
            </li>
            <?=createMenu() ?>
          </ul>
        </div>
      </div>

      <div class="col-md-10 col-sm-12 col-lg-10">
      <?php 
        if (!empty($error)) {
          echo $error;
        }
        else {
      ?>
      <?php
      if (isset($tenhang)){
      ?>
        <h2 style="text-transform: uppercase;"><?= $tenhang ?></h2>
      <?php
      }
      ?>
        <div class="row">
          <?php
            while ($row = $data->fetch_assoc()) {
            ?>
              <div class="col-md-3 col-sm-6 col-lg-3 col-6">
                <a href="chitiet.php?id=<?=$row['id']?>">
                  <div class="card">
                    <div class="show-img-product">
                      <img src="uploads/<?=$row['img'] ?>" class="product-mage">
                    </div>
                    <div class="card-title">
                      <h6><?= $row['tensp'] ?></h6>                  
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
        <?php
        }
      ?>
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
                  <input style="width: 90%;margin-right: 1rem;" id="nav-search" value="" name="nav-search"class="form-control mr-sm-2" type="text" placeholder="Search">          
                </div>

                <div class="form-group">
                  <button style="background-color: #3C1A5B;color: #FFFF00;font-weight: 700;" class="btn" name="btn-nav-search" type="submit">Tìm kiếm</button>
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

  <!--MODAL DANG KI LAI THU-->
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
  <!--SIEDDNAV-->
  <div id="mySidenav" class="sidenav">
    <a href="#" data-toggle="modal" data-target="#infoModal" id="about"><i class="fa fa-automobile"></i> Đăng kí lái thử</a>
    <a  data-toggle="modal" data-target="#lienhetuvanModal" id="blog"><i class="fa fa-commenting"> </i> Liên hệ tư vấn</a>
    <a href="https://www.messenger.com/t/107059197909076" target="_blank" id="projects"><i class="fa fa-facebook-official"></i> Nhắn tin qua FB</a>
    <a href="#" id="contact"><i class="fa fa-phone"></i> Yêu cầu gọi lại</a>
  </div>

  <!--Footer-->
  <?php
  include_once('footer.php');
  include_once('lienhetuvan.php');
  ?>

  <!-- Bootstrap core JavaScript -->

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>






        
          
          
          

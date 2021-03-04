<?php
require_once('conn.php');
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $getProduct = getDetail($id);
    if ($getProduct['code'] == '0') {
      $data = $getProduct['result'];
      $row = $data->fetch_assoc();
    }

    $getProductbyId = getProductbyId_client($id);
    if ($getProductbyId['code'] == '0') {
      $data = $getProductbyId['result'];
      $product = $data->fetch_assoc();
      $mahang = $product['mahang'];
      $maloaixe = $product['maloaixe'];

      $productbyBranchAndBrand = getProductbyBranchandBrand($mahang, $maloaixe);
      if ($productbyBranchAndBrand['code'] == '0') {
        $productLienquan = $productbyBranchAndBrand['result'];
      }
    }
    $getInfo = getInfoWeb();
    if ($getInfo['code'] == '0') {
      $infoWeb = $getInfo['result'];
      $info = $infoWeb->fetch_assoc();
    }
    $getImg = get_DetailImg($id);
    $get_small_img = get_DetailImg_small($id);
    if ($getImg['code'] == '0') {
      $imgs = $getImg['result'];
      $imgsmall = $get_small_img['result'];
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$row['tensp'] ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- STYLE-->
  <link rel="stylesheet" href="style.css" />
</head>

<body id="chitiet">
  <!-- Navigation -->
<?php
  include_once('nav.php');
?>

  <section id="head_page">
    <div class="row">
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

      <div class="col-md-4 col-sm-12 col-lg-4 " >
        <div class="container">
          <?php 
          while ($img = $imgs->fetch_assoc()){

          ?>
          <div class="mySlides">
            <div class="numbertext">1 / 4</div>
              <img src="uploads/<?=$img['img'] ?>" style="width:100%;height: 400px;">
          </div>
          <?php
          }
          ?>

          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>

          <div class="row images-slides">
          <?php 
          $stt = 0;
          while($ig = $imgsmall->fetch_assoc()){
          ?>
            <div class="column">
              <img class="demo cursor" src="uploads/<?= $ig['img'] ?>" style="width:100%;height: 50%;" onclick="currentSlide(<?=$stt+=1 ?>)" >
            </div>
          <?php
          }
          ?>
          </div>          
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-lg-6">
        <p><h3>Hyundai Mighty EX8 – Tải 7T2</h3></p>
        <ul>
          <li class="product-feature">
            <span>Nhãn hiệu:</span>
            <span><strong><?= $row['tensp'] ?></strong></span>
          </li>

          <li class="product-feature">
            <span>Trọng lượng bản thân:</span>
            <span><strong><?= $row['trongluongbanthan'] ?></strong></span>
          </li>

          <li class="product-feature">
            <span>Tải trọng cho phép:</span>
            <span><strong><?= $row['taitrongchophep'] ?></strong></span>
          </li>

          <li class="product-feature">
            <span>Trọng lượng toàn bộ:</span>
            <span><strong><?= $row['trongluongtoanbo'] ?></strong></span>
          </li>

          <li class="product-feature">
            <span>Kích thước xe:</span>
            <span><strong><?= $row['kichthuocxe'] ?></strong></span>
          </li>

          <li class="product-feature">
            <span>Kích thước lồng thùng:</span>
            <span><strong><?= $row['kichthuoclongthung'] ?></strong></span>
          </li>

          <li class="product-feature">
            <span>Lốp trước/sau:</span>
            <span><strong><?= $row['loptruocsau'] ?></strong></span>
          </li>
        </ul>
        <div class="div-price-product">
          <p>Giá bán:</p>
          <p class="price-product">
            <button type="button" class="btn btn-danger btn-add" data-tensp="<?= $row['tensp'] ?>" data-maxe="<?= $row['id'] ?>" data-toggle="modal" data-target="#lienheModal">LIÊN HỆ NGAY</button>
          </p>
        </div>
      </div>
    </div>
  </section>

  <div class="row">

    <div class="nav-menu col-md-12 col-sm-12 col-lg-12">
      <ul class="product-tab">
        <li><a href="#noi-bat">Nổi bật</a></li>
        <li><a href="#ngoai-that">Ngoại thất</a></li>
        <li><a href="#noi-that">Nội thất</a></li>
        <li><a href="#van-hanh">Vận hành</a></li>
        <li><a href="#thong-so-xe">Thông số xe</a></li>
      </ul>
    </div>

    <div class="col-md-12 col-sm-12 col-lg-12">
      <div id="noi-bat" class="detail-product">
        <h3>Nổi bật</h3>
        <div class="detail-content">
          <?=$row['mota'] ?>
        </div>    
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-lg-12">
      <div id="noi-that" class="detail-product">
        <h3>Nội thất</h3>
        <div class="detail-content">
          <?=$row['noithat'] ?>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-lg-12">
      <div id="ngoai-that" class="detail-product">
        <h3>Ngoại thất</h3>
        <div class="detail-content">
          <?=$row['ngoaithat'] ?>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-12 col-lg-6">
      <div id="thong-so-xe" class="detail-product">
        <h3>Thông số xe</h3>
        <table class="table">
          <tbody>
          <?php
          if (!empty($row['trongluongbanthan'])){
          ?>
            <tr>
              <td>Trọng lượng bản thân</td>
              <td><?=$row['trongluongbanthan'] ?></td>
            </tr>
          <?php
            }
          ?>

          <?php
          if (!empty($row['taitrongchophep'])){
          ?>
            <tr>
              <td>Tải trọng cho phép chở:</td>
              <td><?= $row['taitrongchophep'] ?></td>
            </tr>
          <?php
          }
          if (!empty($row['trongluongtoanbo'])){
          ?>
            <tr>
              <td>Trọng lượng toàn bộ:</td>
              <td>1915</td>
            </tr>
          <?php
          }
          if (!empty($row['kichthuocxe'])){
          ?>
            <tr>
              <td>Kích thước xe : Dài x Rộng x Cao</td>
              <td> <?= $row['kichthuocxe'] ?></td>
            </tr>
          <?php
          }
          if (!empty($row['kichthuoclongthung'])){
          ?>
            <tr>
              <td>Kích thước lòng thùng hàng (hoặc kích thước bao xi téc):</td>
              <td> <?= $row['kichthuoclongthung'] ?></td>
            </tr>
          <?php
          }
          if (!empty($row['loptruocsau'])){
          ?>
            <tr>
              <td>Lốp trước sau:</td>
              <td><?=$row['loptruocsau'] ?></td>
            </tr>
          <?php
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-lg-12">
      <div class="detail-product">
      <h3>Sản phẩm liên quan</h3>
      <div class="product-lienquan">
      <?php
      if (!empty($productLienquan)) {
        while ($row = $productLienquan->fetch_assoc()) {
        ?>
        <a href="chitiet.php?id=<?=$row['id'] ?>">
          <div class="card">
            <div class="show-img-product">
              <img src="uploads/<?=$row['img'] ?>" class="product-mage">
            </div>
            <div class="card-title">
              <h6><?=$row['tensp'] ?></h6>                      
            </div>
            <div class="card-body">
              <div class="add">
                <button type="button" class="btn btn-danger btn-add">XEM CHI TIẾT</button>
              </div>
            </div>
          </div>
        </a>
        <?php
        }
      }
      ?>
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
  <!--SIDE-NAV-->
  <div id="mySidenav" class="sidenav">
    <a href="#" data-toggle="modal" data-target="#infoModal" id="about"><i class="fa fa-automobile"></i> Đăng kí lái thử</a>
    <a  data-toggle="modal" data-target="#lienhetuvanModal" id="blog"><i class="fa fa-commenting"> </i> Liên hệ tư vấn</a>
    <a href="https://www.messenger.com/t/107059197909076" target="_blank" id="projects"><i class="fa fa-facebook-official"></i> Nhắn tin qua FB</a>
    <a href="#" id="contact"><i class="fa fa-phone"></i> Yêu cầu gọi lại</a>
  </div>
<?php
  include_once('lienheModal.php');
  include_once('lienhetuvan.php');
  include_once('footer.php');
?>

  <!-- Bootstrap core JavaScript -->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" rel="stylesheet"/>
<!--SLICK-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.0/slick-theme.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.0/slick.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.0/slick.css" rel="stylesheet"/>
<script src="main.js"></script>
</body>
  <script>
    $(document).ready(function() {
        $('body').scroll(function() {
          height = $('#chitiet').height();
          alert(height);
        })
      $('.product-lienquan').slick({
        dots: true,
        infinite: true,
        speed: 300,
        autoplay: true,
        slidesToShow: 4,
        vertical: false,
        slidesToScroll: 1,
      })
    });
  var slideIndex = 1;
  showSlides(slideIndex);

  // Next/previous controls
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  // Thumbnail image controls
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
  }

  </script>
</html>

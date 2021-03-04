<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Vua 4 bánh</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- STYLE-->
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <!-- Navigation -->
  <?php
  include_once('nav.php');
  ?>


  <!-- Page Content -->
  <div id="page-dutoan">
    <form action="">
      <h3>DỰ TOÁN CHI PHÍ</h3>
      <div class="row">
        <div class="col-md-6 col-sm-12 col-lg-6">
          <div class="form-group">
            <label for="loaixe">Loại xe <span style="color:red">*</span></label>
            <select class="form-control" name="loaixe" id="loaixe">
              <option selected disabled value="">Chọn loại xe</option>
              <option value="xe-chuyen-dung">Xe chuyên dụng</option>
              <optgroup label="Xe tải thùng">
                <option value="xe-tai-thung" >All Xe tải thùng</option>
                <option value="xe-tai-hyundai">Xe tải Hyundai</option>
                <option value="xe-tai-isuzu">Xe tải Isuzu</option>
                <option value="xe-tai-hino">Xe tải Hino</option>
                <option value="xe-tai-suzuki">Xe tải Suzuki</option>
              </optgroup><option value="xe-khach">Xe khách</option>
              <option value="xe-chuyen-dung">Xe chuyên dụng</option>
              <option value="khac">Khác</option>
            </select>
          </div>

          <div class="form-group">
            <label><strong>Chọn tải trọng hoặc số chỗ:</strong></label>
            <div class="form-check">
              <input type="radio" name="chooseOne" id="radio-taitrong">
                <div class="form-group" hidden id="choose-taitrong">
                  <label for="taitrong">Tải trọng:</label>
                  <select name="taitrong" id="taitrong" class="form-group">
                    <option selected disabled value="">Chọn tải trọng</option>
                    <option value="2t">&lt; 2T</option>
                    <option value="2t-3-5t">2T - 3.5T</option>
                    <option value="4t-7t">4T-7T</option>
                    <option value="7-5t-8t">7.5T - 8T</option>
                    <option value="8t-13t">&gt;8T - 13T</option>
                    <option value="13t-15t">&gt;13T - 15T</option>
                    <option value="15t-19t">&gt;15T - 19T</option>
                    <option value="27t-40t">27T-40T</option>
                  </select>
              </div> 
            </div>

            <div class="form-check">
              <input type="radio" name="chooseOne" id="radio-socho">
              <label for="socho">Số chỗ</label>
              <div id="choose-socho" hidden class="form-group ">
                <select name="taitrong" id="taitrong" class="form-group">
                    <option selected disabled value="">Chọn số chỗ:</option>
                    <option value="2t">10c - 24c</option>
                    <option value="2t-3-5t">25c - 40c</option>
                    <option value="45"> >45c</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="phienban">Phiên bản <span style="color:red">*</span>:</label>
            <select class="form-control" name="" disabled="" id="">
              <option selected value="">Chọn phiên bản</option>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-danger" id="btn_dutoan">Dự toán chi phí</button>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-lg-6">
          <div class="form-group">
            <label for="giaxe">Giá xe (bao gồm VAT)</label>
            <input type="text">
          </div>
          <p>Lệ phí trước bạ:</p>
          <div class="form-group">
            <label for="lephi">- Mức lệ phí(%):</label>
            <input type="text" id="lephi" value="2">
          </div>
          <div class="form-group">
            <label for="thanhtien">Thành tiền:</label>
            <input type="text">
          </div>
          <div class="form-group">
            <label for="dangkibien">Phí đăng kí biển số xe</label>
            <input readonly value="300,000" type="text">
          </div>
          <div class="form-group">
            <label for="dichvu">Dịch vụ:</label>
            <select  name="dichvu" id="dichvu">
              <option selected disabled>Phí dịch vụ</option>
              <option value="500">500</option>
              <option value="1000">100</option>
              <option value="2000">2000</option>
              <option value="2000">2000</option>
              <option value="4000">4000</option>
              <option value="5000">5000</option>
              <option value="6000">6000</option>
              <option value="7000">7000</option>
              <option value="8000">8000</option>
              <option value="9000">9000</option>
              <option value="10000">10000</option>
              <option value="1500">15000</option>
              <option value="20000">20000</option>
            </select>
          </div>
          <div class="form-group">
            <label for="phidangkiem">Phí đăng kiểm</label>
            <input readonly value="Gọi để biết chi tiết" type="text">
          </div>
          <div class="form-group">
            <label for="">Phí đường bộ (1 năm)</label>
            <input readonly value="Gọi để biết chi tiết" type="text">
          </div>
          <div class="form-group">
            <label for="">Bảo hiểm bắt buộc</label>
            <input readonly value="Gọi để biết chi tiết" type="text">
          </div>
          <div class="form-group">
            <label for="">Bảo hiểm thân xe</label>
            <input value="0" type="text">
          </div>
          <div class="form-group">
            <label for="tongcong">Tổng cộng:</label>
            <input value="300000" type="text">
          </div>
        </div>
      </div>   
    </form>
  </div>
    <!-- /.row -->

  <!-- Footer -->
  <footer class="py-5 bg-info">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-12 col-lg-4">
          <h3>Thông tin chung</h3>
          <ul>
            <li>Giới thiệu</li>
            <li>Hệ thống chi nhánh</li>
            <li>Hồ sơ năng lực</li>
            <li>Cơ hội nghề nghiệp</li>
          </ul>
        </div>

        <div class="col-md-4 col-sm-12 col-lg-4">
          <h3>Dịch vụ</h3>
          <ul>
            <li>Giới thiệu</li>
            <li>Hệ thống chi nhánh</li>
            <li>Hồ sơ năng lực</li>
            <li>Cơ hội nghề nghiệp</li>
          </ul>
        </div>

        <div class="col-md-4 col-sm-12 col-lg-4">
          
        </div>
      </div>
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="main.js"></script>

</body>
</html>

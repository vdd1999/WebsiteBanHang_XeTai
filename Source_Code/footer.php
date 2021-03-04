<?php
  require_once('conn.php');
  $getInfo = getInfoWeb();
  if ($getInfo['code'] == '0') {
    $info = $getInfo['result'];
    $row = $info->fetch_assoc();
  }
?>
<!--PHONE-->
<div class="hotline-phone-ring-wrap">
  <div class="hotline-phone-ring">
    <div class="hotline-phone-ring-circle"></div>
    <div class="hotline-phone-ring-circle-fill"></div>
    <div class="hotline-phone-ring-img-circle">
      <a href="tel:<?= $row['sdt'] ?>" class="pps-btn-img">
        <img src="images/phone.webp" alt="Gọi điện thoại" width="50">
      </a>
    </div>
  </div>
  <div class="hotline-bar">
    <a href="tel:<?= $row['sdt'] ?>">
      <span class="text-hotline"><?= $row['sdt'] ?></span>
    </a>
  </div>
</div>
  <footer class="py-5">
    <div class="footer-container">
      <div class="row">
        <div id="social">
          <div class="logo-social">
            <div class="row">
              <div class="col-3 col-lg-3 col-md-3 col-sm-3">
                <a target="_blank" href="https://www.facebook.com/dailixetaihyundai/">
                  <img  src="images/facebook.png" alt="">           
                </a>
              </div>

              <div class="col-3 col-lg-3 col-md-3 col-sm-3">
                <a href="https://youtube.com/channel/UCD5Sg53y6GJzrZW3uCBItHQ" target="_blank">
                  <img  src="images/youtube.png" alt="">
                </a>
              </div>

              <div class="col-3 col-lg-3 col-md-3 col-sm-3">
                <a href="https://tiktok.com/@4banh5.0" target="_blank">
                  <img  src="images/tiktok.svg" alt="">
                </a>
              </div>

              <div class="col-3 col-lg-3 col-md-3 col-sm-3">
                <a href="https://zalo.me/1760786490492522578" target="_blank">
                  <img  src="images/zalo.png" alt="">
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-3 col-sm-12 col-lg-3">
          <h3>Thông tin chung</h3>
          <ul id="footer-ul">
            <a href="gioithieu.php"><li>Giới thiệu</li></a>
            <a href="chinhanh.php"><li>Hệ thống chi nhánh</li></a>
            <a href="/uploads/HSNL.pdf"><li>Hồ sơ năng lực</li></a>
            <a href="tuyendung"><li>Cơ hội nghề nghiệp</li></a>
          </ul>
        </div>

        <div class="col-12 col-md-5 col-sm-12 col-lg-5">
          <h3>TỔNG CÔNG TY Ô TÔ MIỀN NAM</h3>
          <ul>
            <li>
              <i class="fa fa-map-marker"></i> <?= $row['diachi'] ?></li>
              <li><i class="fa fa-phone"></i> <?= $row['sdt'] ?></li>
              <li><i class="fa fa-envelope"></i> <?= $row['email'] ?> </li>
          </ul> 
        </div>
        <div class="col-md-4 col-sm-12 col-lg-4 col-12">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d501548.4819192475!2d106.648584!3d10.861151!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb83bdff7f68686b7!2zQ2hpIE5ow6FuaCBDw7RuZyBUeSBUTkhIIFhOSyDDlCBUw7QgTWnhu4FuIE5hbQ!5e0!3m2!1svi!2sus!4v1609143693840!5m2!1svi!2sus" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
      </div>
      <p class="m-0 text-center text-white">Copyright &copy; Dat Vu 2020</p>
    </div>
    <!-- /.container -->
  </footer>
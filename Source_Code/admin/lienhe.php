<?php
  require_once('../conn.php');
  $getKhLienhe = getKhLienhe();
  if ($getKhLienhe['code'] == 0) {
    $kh = $getKhLienhe['result'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ tư vấn</title>

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
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body style="background-color: #1a2035;">
    <div class="wrapper">
      <?php
        include_once('sidebar.php');
      ?>
            <div class="main-content" style="width: 100%;" onclick="w3_close()">
                <div class="navbar">
                    <h2>Thông tin khách hàng liên hệ</h2>
                </div>

                <div class="container">
                  <!-- your content here -->
                  <div class="row">
                     <!-- Quản lí tài khoản -->
                    <div class="col-md-12">
                      <div class="card">
                        <div class="header">
                          <h4>Khách hàng liên hệ tư vấn</h4>
                        </div>
                        <div class="card-body">
                          <div class="table">
                            <table id="show-tk" class="table">
                              <thead>
                                <tr >
                                  <th>STT</th>
                                  <th>Tên khách hàng</th>
                                  <th>SĐT</th>
                                  <th>Email</th>
                                  <th>Tên xe</th>
                                  <th>Ảnh minh họa</th>
                                  <th>Trạng thái</th>
                                  <th>Ngày đăng kí</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $stt = 0;
                                while ($row = $kh->fetch_assoc()) {
                                  $tensp = getNamebyId($row['maxe']);
                                  $img = getImgbyId($row['maxe']);
                              ?>
                                <tr>
                                  <td><?= $stt +=1 ?></td>
                                  <td> <?= $row['hoten'] ?></td>
                                  <td> <?= $row['sdt'] ?></td>
                                  <td> <?= $row['email'] ?></td>
                                  <td> <?= $tensp['result'] ?></td>
                                  <td><img src="../uploads/<?= $img['result']?>" alt=""></td>
                                  <td><button class="btn btn-danger"><?= ($row['trangthai'] == 0) ? "WAITING" : "DONE"?></button></td>
                                  <td><?= date('d M,Y',strtotime($row['ngaydangki'])) ?></td>
                                </tr> 
                              <?php
                                }
                              ?>                 
                              </tbody>                 
                            </table>
                          </div>
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
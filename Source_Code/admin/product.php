<?php
  require_once('../conn.php');
  $getSanpham = getSanpham();
  if ($getSanpham['code'] == 0) {
    $sp = $getSanpham['result'];
  }
?>
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
                    <h2>Trang Chủ</h2>
                </div>

                <div class="container">
                  <!-- your content here -->
                  <div class="row">
                     <!-- Quản lí tài khoản -->
                    <div class="col-md-12">
                      <div class="card">
                        <div class="header">
                          <h4>Quản lý Sản phẩm</h4>
                          <div style="flex: 1 0 1rem;"></div>
                          <div class="plus-icon">
                            <a href="add_product.php">
                              <i class="fa fa-plus" style="font-size:36px;color: white;"></i>
                            </a>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="table">
                            <table id="show-tk" class="table">
                              <thead>
                                <tr >
                                  <th>STT</th>
                                  <th>Tên sản phẩm</th>
                                  <th>Hãng sản xuất</th>
                                  <th>Dòng xe</th>
                                  <th>Ảnh minh họa</th>
                                  <th>Bán chạy</th>
                                  <th>Ngày thêm</th>
                                  <th>Thao tác</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $stt = 0;
                                while ($row = $sp->fetch_assoc()) {
                                  $tenhang = getNamebyMahang($row['mahang']);
                                  $loaixe = getNameBrand($row['maloaixe']);
                              ?>
                                <tr>
                                  <td><?= $stt +=1 ?></td>
                                  <td> <?= $row['tensp'] ?></td>
                                  <td> <?= $tenhang['result']?></td>  
                                  <td> <?= $loaixe['result'] ?></td>
                                  <td><img src="../uploads/<?= $row['img']?>" alt=""></td>
                                  <td><button id="<?=$row['id'] ?>" onclick="banchay(<?= $row['id']?>,this.innerHTML)" class="btn btn-danger"><?= ($row['banchay'] == 0) ? "OFF" : "ON"?></button></td>
                                  <td><?= date('d M,Y',strtotime($row['ngaytao'])) ?></td>
                                  <td><a href="edit_product.php?id=<?=$row['id'] ?>">Edit</a> | <a href="">Xóa</a></td>
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
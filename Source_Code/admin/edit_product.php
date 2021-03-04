<?php
  // unlink("../uploads/iphone-7-plus-128gb-de-400x460.png");
  require_once('../conn.php');
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }
  if (isset($_POST['edit'])) {
    $conn = open_db();
    $tensp = $_POST['tensp'];
    $hang = $_POST['hang'];
    $loaixe = $_POST['loaixe'];
    $taitrongchophep = $_POST['taitrongchophep'];
    $trongluongbanthan = $_POST['trongluongbanthan'];
    $trongluongtoanbo = $_POST['trongluongtoanbo'];
    $kichthuocxe =$_POST['kichthuocxe'];
    $kichthuoclongthung = $_POST['kichthuoclongthung'];
    $mota = $_POST['mota'];
    $ngoaithat = $_POST['ngoaithat'];
    $noithat = $_POST['noithat'];

    if ($_FILES['filename']['size']  != 0){
        $img = $_FILES['filename']['name'];  
        $file = $_FILES["filename"]["tmp_name"];
        $destination = '../uploads/'.$img;
        move_uploaded_file($file, $destination);   
        //UPDATE BẢNG sanpham
        $sql = 'UPDATE sanpham SET tensp = ?,img = ?,mahang = ?,maloaixe = ? WHERE id = ?';
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssiii',$tensp,$img,$hang,$loaixe,$id);
        if (!$stm->execute()) {
          echo $stm->error;
        } 
    }
    else {
      //UPDATE BẢNG sanpham
      $sql = 'UPDATE sanpham SET tensp = ?,mahang = ?,maloaixe = ? WHERE id = ?';
      $stm = $conn->prepare($sql);
      $stm->bind_param('siii',$tensp,$hang,$loaixe,$id);
      if (!$stm->execute()) {
        echo $stm->error;
      }
    }
    sleep(1);

    //UPDATE bảng chitietsanpham
    $sql = 'UPDATE chitietsanpham SET tensp = ?,mota = ?, noithat = ?, ngoaithat = ?, trongluongbanthan = ?, taitrongchophep = ?, trongluongtoanbo = ?, kichthuocxe = ?, kichthuoclongthung = ?, loptruocsau = ? where id = ?';
    $stm = $conn->prepare($sql);
    $stm->bind_param('ssssssssssi',$tensp,$mota,$noithat,$ngoaithat,$trongluongbanthan,$taitrongchophep,$trongluongtoanbo,$kichthuocxe,$kichthuoclongthung,$loptruocsau,$id);
    if (!$stm->execute()) {
        echo $stm->error;
    }
    // Count # of uploaded files in array
    $total = count($_FILES['upload']['name']);

    // Loop through each file
    if ($total > 1) {
      echo $total;
      $deleteDetailImg = deleteDetailImg($id);
      if ($deleteDetailImg['code'] == '0') {
        for( $i=0 ; $i < $total ; $i++ ) {
          $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
          $img_detail = $_FILES['upload']['name'][$i];
          if ($tmpFilePath != ""){
            $destination = "../uploads/" . $img_detail;
            if(move_uploaded_file($tmpFilePath, $destination)) {
              $sql = "INSERT INTO anhchitiet(maxe,img) values(?,?)";
              $stm = $conn->prepare($sql);
              $stm->bind_param('is',$id,$img_detail);
              if (!$stm->execute()){
                echo "Không thể thêm ảnh chi tiết"."  ".$stm->error;
              }
            }
          }
        }
      }
      else {
        echo $deleteDetailImg['msg'];
      }
    }
  }
  $getHang = getHang();
  if ($getHang['code'] == 0) {
    $thongtinhang = $getHang['result'];
  }
  $getLoaixe = getLoaixe();
  if ($getLoaixe['code'] == 0) {
    $thongtinloaixe = $getLoaixe['result'];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>CHỈNH SỬA SẢN PHẨM</title>

  <!-- (1): Khai báo sử dụng thư viện CKEditor -->
  <!--  <script src="../ckeditor/ckeditor.js"></script>-->
  <script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css" />
  <!--JAVA SCRIPT-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" rel="stylesheet"/>

  <!-- STYLE-->
  <style>
    #add-product {
      width: 70%;
      justify-content: center;
      margin-left: 15%;
    }
  </style>
</head>
<body>
  <div id="add-product">
    <h1 id="titlesp"></h1>
    <form enctype="multipart/form-data" method="POST" id="add-product-form" action="edit_product.php?id=<?=$id ?>">
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="tensp">Tên sản phẩm:</label>
            <input type="text" name="tensp" class="form-control" placeholder="Nhập tên sản phẩm" id="tensp">
          </div>  
        </div>
        <div class="col">
          <div class="form-group">
            <label for="img">Hình ảnh</label>
            <div class="custom-file mb-3">
              <input type="file" class="custom-file-input" id="customFile" name="filename">
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <div>
              <img style="width: 50px;height: 50px;" id= "preview" src="" alt="">
            </div>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="hang">Hãng:</label>
            <select class="form-control" name="hang" id="hang">
              <option selected disabled value="">-- Chọn hãng xe --</option>
              <?php
                while($row = $thongtinhang->fetch_assoc()){
              ?>
                <option value="<?=$row['mahang'] ?>"><?=$row['tenhang'] ?></option>
              <?php
                }
              ?>
            </select>
          </div> 
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <div class="custom-file mb-3">
              <label for="detailimg">Chi tiết xe</label>
              <input id="detailimg"class="form-control" name="upload[]" type="file" multiple />
            </div>
            <div class="row" id="chitietxe">
              
            </div>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="hang">Loại xe:</label>
            <select class="form-control" name="loaixe" id="loaixe">
              <option selected disabled value="">-- Chọn loai xe --</option>
              <?php
                while($row = $thongtinloaixe->fetch_assoc()){
              ?>
                <option value="<?=$row['maloaixe'] ?>"><?=$row['tenloaixe'] ?></option>
              <?php
                }
              ?>
            </select>
          </div> 
        </div>
      </div>
      
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="trongluongbanthan">Trọng lượng bản thân:</label>
            <input type="text" class="form-control" id="trongluongbanthan" name="trongluongbanthan" />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="taitrongchophep">Tải trọng cho phép:</label>
            <input type="text" class="form-control" id="taitrongchophep" name="taitrongchophep" />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="trongluongtoanbo">Trọng lượng toàn bộ:</label>
            <input type="text" class="form-control" id="trongluongtoanbo" name="trongluongtoanbo"/>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="kichthuocxe">Kích thước xe:</label>
            <input type="text" class="form-control" id="kichthuocxe" name="kichthuocxe" />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="kichthuoclongthung">Kích thước lòng thùng:</label>
            <input type="text" class="form-control" id="kichthuoclongthung" name="kichthuoclongthung"/>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="loptruocsau">Lốp Trước/sau:</label>
            <input type="text" class="form-control" id="loptruocsau" name="loptruocsau"/>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="mota">Nhập mô tả</label>
        <textarea id="mota" name="mota" cols="50" rows="10"></textarea>
        <script>
          $(document).ready(function() {
            CKEDITOR.replace( 'mota',{
              height: 400,
              filebrowserUploadUrl: "upload.php"
            });
          })
        </script>
      </div>

      <div class="form-group">
        <label for="noithat">Nhập mô tả về ngoại thất</label>
        <textarea id="ngoaithat" name="ngoaithat" cols="50" rows="10"></textarea>
        <script>
          $(document).ready(function() {
            CKEDITOR.replace( 'ngoaithat',{
              height: 400,
              filebrowserUploadUrl: "upload.php"
            });
          })
        </script>
      </div>

      <div class="form-group">
        <label for="ngoaithat">Nhập mô tả về nội thất</label>
        <textarea id="noithat" name="noithat" cols="50" rows="10"></textarea>
        <script>
          $(document).ready(function() {
            CKEDITOR.replace( 'noithat',{
              height: 400,
              filebrowserUploadUrl: "upload.php"
            });
          })
        </script>
      </div>


      <button type="submit" name="edit" class="btn btn-primary">Sửa</button>
    </form>  
  </div>
  <div hidden id="idsp"><?= $id ?></div>
</body>
<script>
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });


  $(document).ready(function() {
    let id = $('#idsp').html();
    $.ajax({
      url: "../actionProduct.php",
      method: "POST",
      data: {
        action: "editProduct",
        id:id 
      },
      dataType: "JSON",
      success: function(data) {
        console.log(data);
        if (data.code == '0') {
          for (i = 0; i < data.detailImg.length; i++) {
            $('#chitietxe').append(
              '<div class="column"><img class="demo cursor" src="../uploads/'+data.detailImg[i].img+'" style="width:50px;height:50px;"></div>');
          }
          $('#titlesp').html(data.result.tensp);
          $('#preview').attr('src','../uploads/'+data.result.img);
          $('#tensp').val(data.result.tensp);
          $('#trongluongtoanbo').val(data.detail.trongluongtoanbo);
          $('#trongluongbanthan').val(data.detail.trongluongbanthan);
          $('#taitrongchophep').val(data.detail.taitrongchophep);
          $('#kichthuoclongthung').val(data.detail.kichthuoclongthung);
          $('#kichthuocxe').val(data.detail.kichthuocxe);
          $('#loptruocsau').val(data.detail.loptruocsau);
          $('#loaixe option[value="'+data.result.maloaixe+'"]').attr('selected','selected');
          $('#hang option[value="'+data.result.mahang+'"]').attr('selected','selected');
          CKEDITOR.instances['mota'].setData(data.detail.mota);
          CKEDITOR.instances['ngoaithat'].setData(data.detail.ngoaithat);
          CKEDITOR.instances['noithat'].setData(data.detail.noithat);
        }
      },
      error: function(data) {
        console.log(data);
      }
    })
  })
</script>
</html>
<?php
	require_once('../conn.php');
	$error = "";
	$msg = "";
	$date = date("Y-m-d H:i:s");
	$parse = strval($date);
	if (isset($_POST['btn-chinhanh'])) {
		if(!empty($_POST['chinhanh-txt'])){
			$chinhanh = $_POST['chinhanh-txt'];
			$conn = open_db();
			$sql = "UPDATE thongtin SET chinhanh = ?,updatetimechinhanh = ?";
			$stm = $conn->prepare($sql);
			$stm->bind_param('ss',$chinhanh,$parse);
			if (!$stm->execute()) {
				$error = $stm->error();
			}
			$msg = "Update chi nhánh thành công";
		}
		else {
			$error = "Vui lòng nhập thông tin";
		}
	}
	if (isset($_POST['btn-gioithieu'])) {
		if(!empty($_POST['gioithieu-txt'])){
			$gioithieu = $_POST['gioithieu-txt'];
			$conn = open_db();
			$sql = "UPDATE thongtin SET gioithieu = ?,updatetimegioithieu = ?";
			$stm = $conn->prepare($sql);
			$stm->bind_param('ss',$gioithieu,$parse);
			if (!$stm->execute()) {
				$error = $stm->error();
			}
			$msg = "Update giới thiệu thành công";
		}
		else {
			$error = "Vui lòng nhập thông tin";
		}
	}
	if (isset($_POST['btn-tuyendung'])) {
		if(!empty($_POST['tuyendung-txt'])){
			$tuyendung = $_POST['tuyendung-txt'];
			$conn = open_db();
			$sql = "UPDATE thongtin SET tuyendung = ?,updatetimetuyendung = ?";
			$stm = $conn->prepare($sql);
			$stm->bind_param('ss',$tuyendung,$parse);
			if (!$stm->execute()) {
				$error = $stm->error();
			}
			$msg = "Update tuyển dụng thành công";
		}
		else {
			$error = "Vui lòng nhập thông tin";
		}
	}

	if (isset($_POST['btn-chantrang'])) {
		if (empty($_POST['diachi'])) {
			$error = "Vui lòng nhập địa chỉ";
		}
		else {
			$diachi = $_POST['diachi'];
		}

		if (empty($_POST['email'])) {
			$error = "Vui lòng nhập email";
		}
		else {
			$email = $_POST['email'];
		}

		if (empty($_POST['sdt'])) {
			$error = "Vui lòng nhập số điện thoại";
		}
		else {
			$sdt = $_POST['sdt'];
		}
		if ($_FILES['logo']['size'] != 0) {
			$logo = $_FILES['logo']['name'];  
	        $filelogo = $_FILES["logo"]["tmp_name"];
	        $destination = '../uploads/'.$logo;
	        move_uploaded_file($filelogo, $destination);
		}
		$conn = open_db();
		$sql = "UPDATE thongtin SET diachi = ?,email = ?,sdt = ?,logo = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('ssss',$diachi,$email,$sdt,$logo);
		if (!$stm->execute()) {
			$error = $stm->error();
		}
		$msg = "Update chân trang thành công";
	}

	if (isset($_POST['btn-slide'])) {
		$conn = open_db();
		if ($_FILES['anhlon']['size'] != 0) {
			$anhlon = $_FILES['anhlon']['name'];  
	        $filelon = $_FILES["anhlon"]["tmp_name"];
	        $destination = '../uploads/'.$anhlon;
	        move_uploaded_file($filelon, $destination);
	        $conn->query("UPDATE thongtin SET anhlon ='$anhlon'");
	        $msg = "Update slide lớn thành công";
		}
		if ($_FILES['anhnho1']['size'] != 0) {
			$anhnho1 = $_FILES['anhnho1']['name'];  
	        $filenho1 = $_FILES["anhnho1"]["tmp_name"];
	        $destination = '../uploads/'.$anhnho1;
	        move_uploaded_file($filenho1, $destination);
	        $conn->query("UPDATE thongtin SET anhnho1 ='$anhnho1'");
	        $msg = "Update slide nhỏ 1 thành công";
		}
		if ($_FILES['anhnho2']['size'] != 0) {
			$anhnho2 = $_FILES['anhnho2']['name'];  
	        $filenho2 = $_FILES["anhnho2"]["tmp_name"];
	        $destination = '../uploads/'.$anhnho2;
	        move_uploaded_file($filenho2, $destination);
	        $conn->query("UPDATE thongtin SET anhnho2 ='$anhnho2'");
	        $msg = "Update slide nhỏ 2 thành công";
		}

	}
	if (isset($_POST['btn-dautrang'])) {
		$conn = open_db();
		if ($_FILES['logotrai']['size'] != 0) {
			$logotrai = $_FILES['logotrai']['name'];  
	        $filetrai = $_FILES["logotrai"]["tmp_name"];
	        $destination = '../uploads/'.$logotrai;
	        move_uploaded_file($filetrai, $destination);
		}
		if ($_FILES['logophai']['size'] != 0) {
			$logophai = $_FILES['logophai']['name'];  
	        $filephai = $_FILES["logophai"]["tmp_name"];
	        $destination = '../uploads/'.$logophai;
	        move_uploaded_file($filephai, $destination);
		}
		$sql = "UPDATE thongtin SET logotrai = ?, logophai = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('ss',$logotrai,$logophai);
		if (!$stm->execute()) {
			$error = $stm->error();
		}
		$msg = "Update đầu trang thành công";

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Trang</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--CKEDITOR-->
    <script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
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
		.container>.row>div{
			margin-bottom: 1rem;
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
                    <h2>Thiết lập website</h2>
                </div>

                <div id="config" class="container">
                	<?php
                		if (!empty($error)) {
                	?>
	                	<div class="alert alert-danger fade in alert-dismissible show">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true" style="font-size:20px">×</span>
							</button>
						 	<strong>LỖI!</strong> <?= $error ?>.
						</div>
                	<?php
                		}
                		else if (!empty($msg)) {
                	?>
                		<div class="alert alert-success fade in alert-dismissible show">
                			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true" style="font-size:20px">×</span>
							</button>
							<strong>THÀNH CÔNG!</strong> <?= $msg ?>.
						</div>
                	<?php
                		}
                	?>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="card one">
                                <div class="card-tittle">Giới thiệu</div>
                                <div style="flex: 1 0 1rem"></div>
                                <div class="icon-info">
                                	<i class="fa fa-angle-double-down" data-toggle="collapse" data-target="#gioithieu"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="card two">
								<div class="card-tittle">Hệ thống chi nhánh</div>
                                <div style="flex: 1 0 1rem"></div>
                                <div class="icon-info">
                                	<i class="fa fa-angle-double-down" data-toggle="collapse" data-target="#chinhanh"></i>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="card three">
                                <div class="card-tittle">Tuyển dụng</div>
                                <div style="flex: 1 0 1rem"></div>
                                <div class="icon-info">
                                	<i class="fa fa-angle-double-down" data-toggle="collapse" data-target="#tuyendung"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="card three">
                                <div class="card-tittle">Chân trang</div>
                                <div style="flex: 1 0 1rem"></div>
                                <div class="icon-info">
                                	<i class="fa fa-angle-double-down" data-toggle="collapse" data-target="#chantrang"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="card two">
                                <div class="card-tittle">Slide</div>
                                <div style="flex: 1 0 1rem"></div>
                                <div class="icon-info">
                                	<i class="fa fa-angle-double-down" data-toggle="collapse" data-target="#slide"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="card one">
                                <div class="card-tittle">Đầu trang</div>
                                <div style="flex: 1 0 1rem"></div>
                                <div class="icon-info">
                                	<i class="fa fa-angle-double-down" data-toggle="collapse" data-target="#dautrang"></i>
                                </div>
                            </div>
                        </div>

                        <div id="gioithieu" class="collapse col-12 col-lg-12 col-12 col-md-12">
                        	<form action="thongtin.php" method="POST">
                        		<div class="form-group">
									<label for="gioithieu">Nhập mô tả:</label>
									<textarea id="gioithieu-txt" name="gioithieu-txt" cols="50" rows="10"></textarea>
									<script>
										$(document).ready(function() {
											CKEDITOR.replace( 'gioithieu-txt',{
									            height : 400,
									            filebrowserUploadUrl: "upload.php"
									        });
										});
									</script>
								</div>
								<div class="form-group">
									<button class="btn btn-primary" name="btn-gioithieu">Sửa thông tin giới thiệu</button>
								</div>
                        	</form>
                        </div>

                        <div id="chinhanh" class="collapse col-12 col-lg-12 col-12 col-md-12">
                        	<form action="thongtin.php" method="POST">
                        		<div class="form-group">
									<label for="chinhanh-txt">Nhập mô tả chi nhánh:</label>
									<textarea id="chinhanh-txt" name="chinhanh-txt" cols="50" rows="10"></textarea>
									<script>
										$(document).ready(function() {
											CKEDITOR.replace( 'chinhanh-txt',{
									            height : 400,
									            filebrowserUploadUrl: "upload.php"
									        });
										});
									</script>
								</div>
								<div class="form-group">
									<button class="btn btn-primary" name="btn-chinhanh">Sửa thông tin chi nhánh</button>
								</div>
                        	</form>
                        </div>

                        <div id="tuyendung" class="collapse col-12 col-lg-12 col-12 col-md-12">
                        	<form action="thongtin.php" method="POST">
                        		<div class="form-group">
									<label for="tuyendung-txt">Nhập mô tả tuyển dụng:</label>
									<textarea id="tuyendung-txt" name="tuyendung-txt" cols="50" rows="10"></textarea>
									<script>
										$(document).ready(function() {
											CKEDITOR.replace( 'tuyendung-txt',{
									            height : 400,
									            filebrowserUploadUrl: "upload.php"
									        });
										});
									</script>
								</div>
								<div class="form-group">
									<button class="btn btn-primary" name="btn-tuyendung">Sửa thông tin tuyển dụng</button>
								</div>
                        	</form>
                        </div>

                        <div id="chantrang" class="collapse col-12 col-lg-12 col-12 col-md-12">
                        	<form enctype="multipart/form-data"  action="thongtin.php" method="POST">
                        		<div class="form-group">
                        			<label for="diachi">Đại chỉ: </label>
                        			<input type="text" class="form-control" placeholder="Nhập địa chỉ" id="diachi" name="diachi">
                        		</div>

                        		<div class="form-group">
                        			<label for="sdt">Số điện thoại: </label>
                        			<input type="text" class="form-control" placeholder="Nhập địa chỉ" id="sdt" name="sdt">
                        		</div>

                        		<div class="form-group">
                        			<label for="email">Email: </label>
                        			<input type="text" class="form-control" placeholder="Nhập email" id= "email" name="email">
                        		</div>

                        		<div class="form-group">
                        			<label for="logo">LOGO: </label>
                        			<input type="file" class="form-control" id= "logo" name="logo">
                        		</div>

                        		<div class="form-group">
									<button class="btn btn-primary" name="btn-chantrang">Sửa thông tin chân trang</button>
								</div>
                        	</form>
                        </div>

                        <div id="slide" class="collapse col-12 col-lg-12 col-12 col-md-12">
                        	<form enctype="multipart/form-data"  action="thongtin.php" method="POST">
                        		<table class="table">
                        			<tbody style="color: white">
                        				<tr>
                        					<td>Ảnh lớn</td>
                        					<td >Preview</td>
                        				</tr>
                        				<tr>
                        					<td><input type="file" name="anhlon" ></td>
                        					<td><img style="width: 100px;height: 100px;" id="anhlon" src="" alt=""></td>
                        				</tr>
                        				<tr>
                        					<td>Ảnh nhỏ 1</td>
                        					<td >Preview</td>
                        				</tr>
                        				<tr>
                        					<td><input type="file" name="anhnho1" ></td>
                        					<td><img style="width: 100px;height: 100px;" id="anhnho1" src="" alt=""></td>
                        				</tr>
                        				<tr>
                        					<td>Ảnh nhò 2</td>
                        					<td >Preview</td>
                        				</tr>
                        				<tr>
                        					<td><input type="file" name="anhnho2" ></td>
                        					<td><img style="width: 100px;height: 100px;" id="anhnho2" src="" alt=""></td>
                        				</tr>
                        			</tbody>
                        		</table>
                        		<div class="form-group">
									<button class="btn btn-primary" name="btn-slide">Sửa slide</button>
								</div>
                        	</form>
                        </div>

                        <div id="dautrang" class="collapse col-12 col-lg-12 col-12 col-md-12">
                        	<form enctype="multipart/form-data" action="thongtin.php" method="POST">
                        		<div class="form-group">
                        			<label for="logo">LOGO TRÁI: </label>
                        			<input type="file" class="form-control" id= "logotrai" name="logotrai">
                        		</div>

                        		<div class="form-group">
                        			<label for="logo">LOGO PHẢI: </label>
                        			<input type="file" class="form-control" id= "logophai" name="logophai">
                        		</div>

                        		<div class="form-group">
									<button class="btn btn-primary" name="btn-dautrang">Sửa đầu trang</button>
								</div>
                        	</form>
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

		$(document).ready(function() {
			$.ajax({
				url: "../actionProduct.php",
				method: "POST",
				data: {action: "getThongtinPage"},
				dataType: "JSON",
				success: function(data){
					if (data.code == "0") {
						console.log(data.result);
						CKEDITOR.instances['gioithieu-txt'].setData(data.result.gioithieu);
						CKEDITOR.instances['tuyendung-txt'].setData(data.result.tuyendung);
						CKEDITOR.instances['chinhanh-txt'].setData(data.result.chinhanh);
						$('#diachi').val(data.result.diachi);
						$('#sdt').val(data.result.sdt);
						$('#email').val(data.result.email);
						$('#anhlon').attr('src','/webminhheo/uploads/'+data.result.anhlon);
						$('#anhnho1').attr('src','/webminhheo/uploads/'+data.result.anhnho1);
						$('#anhnho2').attr('src','/webminhheo/uploads/'+data.result.anhnho2);		
					}
				},
				error: function(data){
					console.log(data.msg);
				}
			})
		})
    </script>
</body>
</html>
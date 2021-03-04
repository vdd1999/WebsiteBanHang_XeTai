<?php
	define('servername','localhost');
	define('username','root');
	define('password','root');
	define('db','vua4banh');
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'vendor/autoload.php';
	function open_db() {
		$conn = new mysqli(servername, username, password, db);
		
		if ($conn->connect_error) {
			die($conn->connect_error);
		}
		return $conn;
	}

	//ĐĂNG NHẬP
	function login ($user, $pass) {
		$sql = "select * from taikhoan where taikhoan = ?";
		$conn = open_db();
		$stm =$conn->prepare($sql);
		$stm->bind_param('s', $user);
		if (!$stm -> execute()) {
			return array('code' => 1,'error'=>'Cannot execute command');
		}

		$result = $stm->get_result();

		if ($result->num_rows == 0) {
			return array('code' => 1,'error'=>'Account does not exist');
		}
		$data = $result->fetch_assoc();
		$hash_pass = $data['matkhau'];
		if (!password_verify($pass, $hash_pass)) {
			return array('code' => 2,'error'=>'Sai mật khẩu');
		}
		else if ($data['is_activated'] == 0){
			return array('code' => 3,'error'=>'Tài khoản chưa được kích hoạt','data'=>$data);
		}
		else return array('code' => 0,'data'=>$data);


	}
	function getHang() {
		$conn = open_db();
		$sql = "SELECT * FROM hang";
		$stm = $conn->prepare($sql);
		$tenhang;
		if (!$stm->execute()) {
			return array('code'=>2,"msg"=>"SEVER CANNOT COMMAND");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			return array('code'=>0,"result"=>$result);
		}
		return array('code'=>1,"msg"=>"Không có hãng");	
	}
	function getLoaixe() {
		$conn = open_db();
		$sql = "SELECT * FROM loaixe";
		$stm = $conn->prepare($sql);
		if (!$stm->execute()) {
			return array('code'=>2,"msg"=>"SEVER CANNOT COMMAND");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			return array('code'=>0,"result"=>$result);
		}
		return array('code'=>1,"msg"=>"Không có sản phẩm");	
	}
	function getSanpham() {
		$conn = open_db();
		$sql = "SELECT * FROM sanpham";
		$stm = $conn->prepare($sql);
		if (!$stm->execute()) {
			return array('code'=>2,"msg"=>"SEVER CANNOT COMMAND");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			return array('code'=>0,"result"=>$result);
		}
		return array('code'=>1,"msg"=>"Không có sản phẩm");	
	}

	//LẤY SẢN PHẨM THEO MÃ SAN3 PHẨM
	function getProductbyId_client($id) {
		$conn = open_db();
		$sql = "SELECT * FROM sanpham WHERE id= ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$id);
		if (!$stm->execute()) {
			return array('code'=>2,"msg"=>"SEVER CANNOT COMMAND");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			return array('code'=>0,"result"=>$result);
		}
		return array('code'=>1,"msg"=>"Không có sản phẩm");		
	}

	//Lấy thông tin khách hàng đăng kí lái thử
	function getDangKiLaiThu() {
		$conn = open_db();
		$sql = "SELECT * FROM dangkilaithu";
		$stm = $conn->prepare($sql);
		if (!$stm->execute()) {
			return array('code'=>2,"msg"=>"SEVER CANNOT COMMAND");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			return array('code'=>0,"result"=>$result);
		}
		return array('code'=>1,"msg"=>"Không có sản phẩm");	
	}

	//Lấy khách hàng liên hệ tư vấn
	function getKhLienhe() {
		$conn = open_db();
		$sql = "SELECT * FROM lienhe";
		$stm = $conn->prepare($sql);
		if (!$stm->execute()) {
			return array('code'=>2,"msg"=>"SEVER CANNOT COMMAND");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			return array('code'=>0,"result"=>$result);
		}
		return array('code'=>1,"msg"=>"Không có sản phẩm");	

	}

	function getNewProduct() {
		$conn = open_db();
		$sql = "SELECT * FROM sanpham ORDER BY id DESC limit 8";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return array('code'=>0,'result'=>$result);
		}
		return array('code'=>1,'msg'=>'Không có sản phẩm');
	}
	function getDetail($id){
		$conn = open_db();
		$sql = "SELECT * FROM chitietsanpham WHERE id= ?";
		$stm= $conn->prepare($sql);
		$stm->bind_param('i',$id);
		if (!$stm->execute()) {
			return  array('code'=>2,"msg"=>$stm->error);
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			return array('code'=>0,"result"=>$result);
		}
		return array('code'=>1,"msg"=>"Không có sản phẩm");	
	}

	function get_DetailImg($id){
		$conn = open_db();
		$sql = "SELECT * FROM anhchitiet WHERE maxe= ?";
		$stm= $conn->prepare($sql);
		$stm->bind_param('i',$id);
		if (!$stm->execute()) {
			return  array('code'=>2,"msg"=>$stm->error);
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			return array('code'=>0,"result"=>$result);
		}
		return array('code'=>1,"msg"=>"Không có sản phẩm");	
	}
	function get_DetailImg_small($id){
		$conn = open_db();
		$sql = "SELECT * FROM anhchitiet WHERE maxe= ?";
		$stm= $conn->prepare($sql);
		$stm->bind_param('i',$id);
		if (!$stm->execute()) {
			return  array('code'=>2,"msg"=>$stm->error);
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			return array('code'=>0,"result"=>$result);
		}
		return array('code'=>1,"msg"=>"Không có sản phẩm");	
	}
	function getProductbyBranch($mahang){
		$conn = open_db();
		$sql = "SELECT * FROM sanpham WHERE mahang = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$mahang);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			return array('code'=>0,'result'=>$result); 
		}
		return array('code'=>1,'msg'=>'Không có sản phẩm');
	}

	function getProductbyBrand($maloaixe)
	{
		$conn = open_db();
		$sql = "SELECT * FROM sanpham WHERE maloaixe = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$maloaixe);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		if ($result->num_rows > 0){
			return array('code'=>0,'result'=>$result); 
		}
		return array('code'=>1,'msg'=>'Không có sản phẩm');
	}
	function getProductbyBranchandBrand($mahang,$maloaixe)
	{
		$conn = open_db();
		$sql = "SELECT * FROM sanpham WHERE mahang = ? and maloaixe = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('ii',$mahang,$maloaixe);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		if ($result->num_rows > 0){
			return array('code'=>0,'result'=>$result); 
		}
		return array('code'=>1,'msg'=>'Không có sản phẩm');		
	}

	function getNamebyMahang($mahang) {
		$conn = open_db();
		$sql = "SELECT tenhang FROM hang WHERE mahang = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$mahang);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		$name = $result->fetch_assoc();
		if ($result->num_rows>0){
			return array('code'=>0,'result'=>$name['tenhang']); 
		}
		return array('code'=>1,'msg'=>'Không có sản phẩm');
	}

	//LẤY MÃ HÃNG THEO TÊN HÃNG
	function getMahang($tenhang) {
		$conn = open_db();
		$s = strtolower($tenhang);
		$sql = "SELECT mahang FROM hang WHERE tenhang = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$s);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		$row = $result->fetch_assoc();
		return $row['mahang'];
	}
	function searchProduct($s) {
		$conn = open_db();
		$ss = strtolower($s);
		if ($ss == "suzuki" 
			|| $ss == "huyndai" 
			|| $ss == "fuso" 
			|| $ss == "isuzu" 
			|| $ss == "hino") 
		{
			$mahang = getMahang($ss);
			$sql = "SELECT * FROM sanpham WHERE mahang = ?";
			$stm = $conn->prepare($sql);
			$stm->bind_param('i',$mahang);
			if (!$stm->execute()) {
				return array('code'=>2,'msg'=>"SEVER can not command");
			}
			$result = $stm->get_result();
			if ($result->num_rows > 0){
				return array('code'=>0,'result'=>$result,'tenhang'=>$s);
			}
			else {
				return array('code'=>1,'msg'=>'Không tìm thấy sản phẩm');
			}
		}
		$string = "%$s%";
		$sql = "SELECT * FROM sanpham WHERE tensp like ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$string);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		if ($result->num_rows > 0){
			return array('code'=>0,'result'=>$result);
		}
		else {
			return array('code'=>1,'msg'=>'Không tìm thấy sản phẩm');
		}
	}
	function createMenu() {
		$getHang = getHang();
		if ($getHang['code'] == 0) {
			$thongtinhang = $getHang['result'];
		}
		while ($row = $thongtinhang->fetch_assoc()) {
		?>
		    <li class="dropright">
              <a href="product.php?mahang=<?= $row['mahang']?>"> <?= $row['tenhang'] ?> </a>
              <ul class="sub-menu">
              	<?=getSub_menu($row['mahang']) ?>
              </ul>
            </li>
		<?php
		}
	}

	function createModalMenu() {
		$getHang = getHang();
		if ($getHang['code'] == 0) {
			$thongtinhang = $getHang['result'];
		}
		while ($row = $thongtinhang->fetch_assoc()) {
		?>
			<li class="menu-modal-li" data-toggle="collapse" data-target="#<?= $row['tenhang']?>">
				<a href=""><?=$row['tenhang'] ?></a>
				<span style="flex: 1 0 1rem;"></span>
			<i  class="fa fa-angle-double-down"></i>
			</li>
			<ul id="<?= $row['tenhang']?>" class="collapse submenu-modal">
				<?=getSub_menuModal($row['mahang']) ?>
			</ul>
		<?php
		}
	
	}
	function getSub_menuModal($mahang) {
		$conn = open_db();
		$sql = "SELECT maloaixe FROM mucluc WHERE mahang = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$mahang);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			while($row = $result->fetch_assoc()) {
				get_name_Sub_menu($mahang,$row['maloaixe']);
			}
		}
	}

	function getSub_menu($mahang) {
		$conn = open_db();
		$sql = "SELECT maloaixe FROM mucluc WHERE mahang = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$mahang);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0){
			while($row = $result->fetch_assoc()) {
				get_name_Sub_menu($mahang,$row['maloaixe']);
			}
		}
	}
	function get_name_Sub_menu($mahang,$maloaixe){
		$conn = open_db();
		$sql = "SELECT tenloaixe FROM loaixe WHERE maloaixe = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$maloaixe);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		$row = $result->fetch_assoc();
		$name = $row['tenloaixe'];
		echo "<li><a href='product.php?mahang=$mahang&loaixe=$maloaixe'>$name</a></li>";
	}

	//LẤY TÊN LOẠI XE THEO MÃ
	function getNameBrand($maloaixe) {
		$conn = open_db();
		$sql = "SELECT tenloaixe FROM loaixe WHERE maloaixe = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$maloaixe);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0) {
			$row = $result->fetch_assoc();
			$name = $row['tenloaixe'];
			return array('code'=>0,'result'=>$name);
		}
		return array('code'=>1,'msg'=>'Không có sản phẩm');
	}

	//Lấy tên sản phẩm theo mã sản phẩm
	function getNamebyId($id) {
		$conn = open_db();
		$sql = "SELECT tensp FROM sanpham WHERE id = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$id);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0) {
			$row = $result->fetch_assoc();
			$name = $row['tensp'];
			return array('code'=>0,'result'=>$name);
		}
		return array('code'=>1,'msg'=>'Không có sản phẩm');
	}

	//Lấy hình ảnh theo mã san phẩm
	function getImgbyId($id) {
		$conn = open_db();
		$sql = "SELECT img FROM sanpham WHERE id = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$id);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER can not command");
		}
		$result = $stm->get_result();
		if ($result->num_rows>0) {
			$row = $result->fetch_assoc();
			$name = $row['img'];
			return array('code'=>0,'result'=>$name);
		}
		return array('code'=>1,'msg'=>'Không có sản phẩm');
	}

	function getBestSeller(){
		$conn = open_db();
		$sql = "SELECT * FROM sanpham where banchay = 1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return array('code'=>0,'result'=>$result);
		}
		return array('code'=>1,'msg'=>'Không có sản phẩm');

	}

	function deleteDetailImg($id) {
		$conn = open_db();
		$sql = "SELECT * FROM anhchitiet WHERE maxe = ?";
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$id);
		if (!$stm->execute()) {
			return array('code'=>1,'msg'=>"SEVER CANNOT COMMAND");
		}
		$array = array();
		$result = $stm->get_result();
		if ($result->num_rows > 0) {
			// while ($row = $result->fetch_assoc()) {
			//     array_push($array,$row);
			// }
			foreach ($result as $row) {
				$img = $row['img'];
				if (!unlink("../uploads/$img")) {
					return array('code'=>1,"msg"=>"Không thể xóa file");
				}
			}
		}

		$sql = "DELETE FROM anhchitiet WHERE maxe = ?";
	    $stm = $conn->prepare($sql);
	    $stm->bind_param('i',$id);
	    if (!$stm->execute()) {
	    	return array('code'=>1,'msg'=>"SEVER CANNOT COMMAND");
	    }
	    return array('code'=>0,'msg'=>'THÀNH CÔNG');
	}

	//LAY61 THONG TIN WEB
	function getInfoWeb() {
		$conn = open_db();
		$sql = "SELECT * FROM thongtin";
		$stm = $conn->prepare($sql);
		if (!$stm->execute()) {
			return array('code'=>2,'msg'=>"SEVER CANNOT COMMAND");
		}
		$result = $stm->get_result();
		if ($result->num_rows > 0) {
			return array('code'=>0,'result'=> $result);
		}
		return array('code'=>1,'msg'=>"Khong co thong tin");
	}

?>
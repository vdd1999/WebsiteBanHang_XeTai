$(document).ready(function() {
	const checkSDT = /((09|03|07|08|05)+([0-9]{8})\b)/g;
	const checkEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var error = "";

	function show_error(string) {
		$('#show-error').removeAttr('hidden');
		$('#msg-error').html("<strong>LỖI!</strong>"+string);
		setTimeout(function() {
			$('#show-error').attr("hidden",true);
		},2500);
	}
	$('#radio-taitrong').change(function() {
		if ($(this).is(':checked')) {
			$('#choose-taitrong').removeAttr('hidden');
			$('#choose-socho').attr('hidden','hidden');
		}
	})
	$('#radio-socho').change(function() {
		if ($(this).is(':checked')) {
			$('#choose-socho').removeAttr('hidden');
			$('#choose-taitrong').attr('hidden','hidden');
		}
	});

	$('#infoModal').on('show.bs.modal', function(e) {
	 	$.ajax({
	 		url: "actionProduct.php",
	 		method: "POST",
	 		data: {
	 			action: "getHang",
	 		},
	 		dataType: "JSON",
	 		success: function(data) {
	 			console.log(data);
	 			for (i = 0; i < data.result.length; i++) {
	 				$('#hang').append('<option value='+data.result[i].mahang+'>'+data.result[i].tenhang+'</option>');
	 			}
	 		},
	 		error: function(data) {
	 			console.log(data)
	 		}
	 	});

	 	$('#hang').change(function() {
	 		let mahang = $('#hang option:selected').val();
	 		$.ajax({
	 			url: "actionProduct.php",
		 		method: "POST",
		 		data: {
		 			action: "getLoaixe",
		 			mahang: mahang
		 		},
		 		dataType: "JSON",
		 		success: function(data) {
		 			console.log(data);
		 			$('#loaixe').html('');
		 			$('#loaixe').removeAttr('hidden');
		 			$('#loaixe').append('<option value="-1" selected disabled="">--Chọn loại xe--</option>');
		 			for (i = 0; i < data.result.length; i++) {
		 				$('#loaixe').append('<option style="text-transform: uppercase;" value='+data.result[i].maloaixe+'>'+data.result[i].tenloaixe+'</option>');
		 			}
		 		},
		 		error: function(data) {
		 			console.log(data)
		 		}
		 	});
	 	});

	 	$('#loaixe').change(function() {
	 		let mahang = $('#hang option:selected').val();
	 		let maloaixe = $('#loaixe option:selected').val();
	 		$.ajax({
	 			url: "actionProduct.php",
		 		method: "POST",
		 		data: {
		 			action: "getMauXeModal",
		 			mahang: mahang,
		 			maloaixe: maloaixe
		 		},
		 		dataType: "JSON",
		 		success: function(data) {
		 			console.log(data);
		 			if (data.code == '0') {
		 				$('#mauxe').html('');
			 			$('#mauxe').removeAttr('hidden');
			 			$('#mauxe').append('<option value="-1" selected disabled>--Chọn mẫu xe--</option>');
			 			for (i = 0; i < data.result.length; i++) {
			 				$('#mauxe').append('<option value='+data.result[i].id+'>'+data.result[i].tensp+'</option>');
			 			}
		 			}
		 			else {
		 				$('#mauxe').html('');
			 			$('#mauxe').removeAttr('hidden');
			 			$('#mauxe').append('<option value="-2" selected disabled>--'+data.msg+'--</option>');

		 			}
		 		},
		 		error: function(data) {
		 			console.log(data)
		 		}
		 	});
	 	});

	 	$('#btn-dangkilaithu').click(function(){
	 		let mahang = $('#hang option:selected').val();
	 		let maloaixe = $('#loaixe option:selected').val();
	 		let mauxe = $('#mauxe option:selected').val();
	 		let hoten = $("#hoten").val();
	 		let email = $("#email").val();
	 		let sdt = $("#sdt").val();

	 		if (hoten == "") {
	 			error = "Vui lòng nhập họ tên";
	 			show_error(error);
	 		}
	 		else if (email == "") {
	 			error = "Vui lòng nhập Email";
	 			show_error(error);
	 		}
	 		else if (!checkEmail.test(email)) {
	 			error = "Email không hợp lệ";
	 			show_error(error);
	 		}
	 		else if (sdt == "") {
	 			error = "Vui lòng nhập Số điện thoại";
	 			show_error(error);
	 		}
	 		else if (!checkSDT.test(sdt)) {
	 			error = 'Số điện thoại của bạn không đúng định dạng!';
		        show_error(error);
	 		}
	 		else if (mahang == -1) {
	 			error = "Vui lòng chọn hãng xe muốn lái thử";
	 			show_error(error);
	 		}
	 		else if (maloaixe == -1) {
	 			error = "Vui lòng chọn loại xe muốn lái thử";
	 			show_error(error);
	 		}
	 		else if (mauxe == -1) {
	 			error = "Vui lòng chọn mẫu xe muốn lái thử";
	 			show_error(error);
	 		}
	 		else if (mauxe == -2) {
	 			error = "Không có mẫu xe để chọn, vui lòng chọn mẫu xe khác";
	 			show_error(error);
	 		}
	 		else {
		 		$.ajax({
		 			url: "actionProduct.php",
			 		method: "POST",
			 		data: {
			 			action: "dangkilaithu",
			 			mahang: mahang,
			 			maloaixe: maloaixe,
			 			id: mauxe,
			 			email: email,
			 			hoten: hoten,
			 			sdt: sdt
			 		},
			 		dataType: "JSON",
			 		success: function(data) {
			 			console.log(data);
						hoten = $("#hoten").val('');
						email = $("#email").val('');
						sdt = $("#sdt").val('');
						$('#infoModal').modal('hide');
						alert(data.msg);

			 		},
			 		error: function(data) {
			 			console.log(data.responseText)
			 		}
			 	});
	 		}
	 	});
	 });

	$('#lienheModal').on('show.bs.modal', function(e) {
		let tensp = $(e.relatedTarget).data("tensp");
		let maxe = $(e.relatedTarget).data("maxe");
		$('#xechon').val(tensp);
		$('#btn-lienhe').click(function(){
	 		let hoten = $("#hotenlienhe").val();
	 		let email = $("#emaillienhe").val();
	 		let sdt = $("#sdtlienhe").val();
	 		if (hoten == "") {
	 			error = "Vui lòng nhập họ tên";
	 			$('#lienhe-error').html(error);
	 			$('#lienhe-error').removeAttr('hidden');
	 		}
	 		else if (email == "") {
	 			error = "Vui lòng nhập Email";
	 			$('#lienhe-error').html(error);
	 			$('#lienhe-error').removeAttr('hidden');
	 		}
	 		else if (!checkEmail.test(email)) {
	 			error = "Email không hợp lệ";
	 			$('#lienhe-error').html(error);
	 			$('#lienhe-error').removeAttr('hidden');
	 		}
	 		else if (sdt == "") {
	 			error = "Vui lòng nhập Số điện thoại";
	 			$('#lienhe-error').html(error);
	 			$('#lienhe-error').removeAttr('hidden');
	 		}
	 		else if (!checkSDT.test(sdt)) {
	 			error = 'Số điện thoại của bạn không đúng định dạng!';
		        $('#lienhe-error').html(error);
	 			$('#lienhe-error').removeAttr('hidden');
	 		}
	 		else {
	            $.ajax({
		 			url: "actionProduct.php",
			 		method: "POST",
			 		data: {
			 			action: "lienhe",
			 			id: maxe,
			 			email: email,
			 			hoten: hoten,
			 			sdt: sdt
			 		},
			 		dataType: "JSON",
			 		success: function(data) {
			 			console.log(data);
			 			hoten = $("#hoten").val('');
						email = $("#email").val('');
						sdt = $("#sdt").val('');
						$('#lienheModal').modal('hide');
						$("#hoten").val('');
						$("#email").val('');
						$("#sdt").val('');
						$('#lienhe-error').html('');
						alert(data.msg);
			 		},
			 		error: function(data) {
			 			console.log(data.responseText);
			 		}
			 	});
		    }
	 	});

	});

	$('#lienhetuvanModal').on('show.bs.modal', function(e) {
		$('#btn-lienhetuvan').click(function(){
	 		let hoten = $("#hotentuvan").val();
	 		let email = $("#emailtuvan").val();
	 		let sdt = $("#sdttuvan").val();
	 		if (hoten == "") {
	 			error = "Vui lòng nhập họ tên";
	 			$('#tuvan-error').html(error);
	 			$('#tuvan-error').removeAttr('hidden');
	 		}
	 		else if (email == "") {
	 			error = "Vui lòng nhập Email";
	 			$('#tuvan-error').html(error);
	 			$('#tuvan-error').removeAttr('hidden');
	 		}
	 		else if (!checkEmail.test(email)) {
	 			error = "Email không hợp lệ";
	 			$('#tuvan-error').html(error);
	 			$('#tuvan-error').removeAttr('hidden');
	 		}
	 		else if (sdt == "") {
	 			error = "Vui lòng nhập Số điện thoại";
	 			$('#tuvan-error').html(error);
	 			$('#tuvan-error').removeAttr('hidden');
	 		}
	 		else if (!checkSDT.test(sdt)) {
	 			error = 'Số điện thoại của bạn không đúng định dạng!';
		        $('#tuvan-error').html(error);
	 			$('#tuvan-error').removeAttr('hidden');
	 		}
	 		else {
	            $.ajax({
		 			url: "actionProduct.php",
			 		method: "POST",
			 		data: {
			 			action: "lienhetuvan",
			 			email: email,
			 			hoten: hoten,
			 			sdt: sdt
			 		},
			 		dataType: "JSON",
			 		success: function(data) {
			 			console.log(data);
			 			hoten = $("#hoten").val('');
						email = $("#email").val('');
						sdt = $("#sdt").val('');
						$('#lienhetuvanModal').modal('hide');
						$("#hotentuvan").val('');
						$("#emailtuvan").val('');
						$("#sdttuvan").val('');
						$('#tuvan-error').html('');
						alert(data.msg);
			 		},
			 		error: function(data) {
			 			console.log(data.responseText);
			 		}
			 	});
		    }
	 	});

	});
});
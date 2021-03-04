function banchay(id,txt) {
	let banchay;
	if (txt == "ON") {
		banchay = 0;
	}
	else {
		banchay = 1;
	}
	$.ajax({
		url: "../actionProduct.php",
		method: "POST",
		dataType: 'JSON',
		data: {
			action: "changeBanchay",
			banchay: banchay,
			id: id
		},
		success: function(data) {
			console.log(data.message);
			if (data.code == '0') {
				if (banchay == 0) {
					$('#'+id).html('OFF');
				}
				else {
					$('#'+id).html('ON');
				}
				
			}
		},
		error: function(data) {
			console.log(data);
		}
	})
}


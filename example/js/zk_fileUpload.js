
$("form#frm_fileUpload").submit(function() {

	$.ajax({
			type: 'POST',
			url: '../php/saveFile.php',
			data: new FormData(this),
			async: false,
			success: function(result) {
				console.log(result);
				switch(parseInt(result)) {
					case 0:
						alert("error while uploading file");
					break;
					case 1:
						alert("success");
					break; 
					case 2:
						alert("wrong extension");
					break;
					case 3:
						alert("file is too large");
					break; 
				}
			},
			cache: false,
			contentType: false,
			processData: false
	});
	return false;
});

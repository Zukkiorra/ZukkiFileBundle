function deleteFile(file_name)
{
	$.ajax({
			type:'POST',
			url:'../php/deleteFile.php',
			data:'file_name='+file_name,
			success:function(result) 
			{
				alert(result);
			}
	});
}
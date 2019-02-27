<?php session_start();?>
<html>
<head>
	<script src="/files/jquery-1.11.3.min.js"></script>
	<script src="/files/jquery.form.min.js"></script>
</head>
<body>

<form id="fileUploadForm" action="import.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="<?=ini_get('session.upload_progress.name')?>" value="csv">

    <div>
        <input type="file" name="csv" required="required">
        <input type="submit" name="send" value="Отправить">
    </div>

    <div id="progress"></div>
    <div id="result"></div>
</form>

<script>
$(document).ready(function () {
    progress = function() {
        $.ajax({
            url: 'upload.php',
            dataType: 'json',
            success: function (data) {
				if (data.percent != undefined)
					$("#progress").html('Загружено: ' + data.percent + '%');
				else
					clearTimeout(t);
            }
        });
    }

    $("#fileUploadForm").ajaxForm({
       type: 'POST',
	   dataType: 'json',
       success: function (data) {
		   $("#result").html(data.message);
           clearTimeout(t);
		   
		   if (data.code == 'ok') {
			   $("#progress").html('100%');
		   }
		   else {
			   $("#progress").html('Ошибка загрузки!');
		   }
       },
	   error: function (data) {
		   $("#progress").html('Ошибка загрузки!');
		   clearTimeout(t);
	   },
       beforeSubmit: function () {
		   $("#progress").html('Идет загрузка файла...');
           t = setInterval("progress()", 1000);
       }
    });
});
</script>

</body>
</html>
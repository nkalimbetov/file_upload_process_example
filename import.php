<?php
session_start();

$result = [];

if ($_FILES['csv']['error'] != UPLOAD_ERR_OK) {
    $result['code'] = 'error';
    $result['message'] = 'Ошибка загурзки файла';
}
else {
	$result['code'] = 'ok';
    $result['message'] = 'Загрузка завершена';
}

echo json_encode($result);
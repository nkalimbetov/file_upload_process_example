<?php
session_start();

$percent = 0;
$data = [];

if (isset($_SESSION['upload_progress_csv']) && is_array($_SESSION['upload_progress_csv'])) {

    $percent = ($_SESSION['upload_progress_csv']['bytes_processed'] * 100) / $_SESSION['upload_progress_csv']['content_length'];
    $percent = round($percent, 2);

    $data = [
        'percent' => $percent,
        'content_length' => $_SESSION['upload_progress_csv']['content_length'],
        'bytes_processed' => $_SESSION['upload_progress_csv']['bytes_processed'],
    ];
}

echo json_encode($data);
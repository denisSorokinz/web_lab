<?php

$errors = [];
$data = [];

if (empty($_POST['theme'])) {
    $errors['theme'] = 'Theme is required.';
}

if (empty($_POST['description'])) {
    $errors['description'] = 'Description is required.';
}

if (empty($_POST['datepicker'])) {
    $errors['datepicker'] = 'datepicker is required.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['description'] = $_POST['description'];
    $data['theme'] = $_POST['theme'];
    $data['datepicker'] = $_POST['datepicker'];

    $file = file_get_contents('data1.json');
    $list = json_decode($file,TRUE); 
    unset($file);

    $list[] = [$data];
    $jsonArr = json_encode($list);
    file_put_contents('data1.json', $jsonArr);
}

echo ($jsonArr);

?>
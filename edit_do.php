<?php
require('dbconnection.php');
$stmt = $db->prepare('update todolist set text=? where id=?');
if(!$stmt){
    die($db->error);
};
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
$stmt->bind_param('si', $text, $id);
$success = $stmt->execute();
if(!$success){
    die($db->error);
};

header('Location: detail.php?id=' . $id);
?>
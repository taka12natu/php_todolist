<?php
$text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS);
require('dbconnection.php');
$stmt = $db->prepare('insert into todolist(text)values(?)');
if(!$stmt){
    die($db->error);
};
$stmt->bind_param('s', $text);
$ret = $stmt->execute();

if($ret){
    echo '登録されました。<br> <a href="index.php">TOPに戻る</a>';
}else{
    echo $db->error;
}
?>